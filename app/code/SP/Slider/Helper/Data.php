<?php
/**
 * @author Pavel Usachev <webcodekeeper@hotmail.com>
 * @copyright Copyright (c) 2017, Pavel Usachev
 */

namespace SP\Slider\Helper;

use Magento\Framework\App\Helper\Context;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\Filesystem;
use Magento\Framework\File\Size;
use Magento\Framework\HTTP\Adapter\FileTransferFactory;
use Magento\MediaStorage\Model\File\UploaderFactory;
use Magento\Framework\Filesystem\Io\File;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\Image\Factory;
use Magento\Framework\Filesystem\Directory\WriteInterface;
use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Framework\UrlInterface;
use Magento\Framework\Validator\Exception;
use Magento\Framework\App\Helper\AbstractHelper;

class Data extends AbstractHelper
{

    /**
     * Media path to extension images
     *
     * @var string
     */
    const MEDIA_PATH    = 'custom_files';

    /**
     * Maximum size for image in bytes
     * Default value is 1M
     *
     * @var int
     */
    const MAX_FILE_SIZE = 1048576;

    /**
     * Manimum image height in pixels
     *
     * @var int
     */
    const MIN_HEIGHT = 50;

    /**
     * Maximum image height in pixels
     *
     * @var int
     */
    const MAX_HEIGHT = 800;

    /**
     * Manimum image width in pixels
     *
     * @var int
     */
    const MIN_WIDTH = 50;

    /**
     * Maximum image width in pixels
     *
     * @var int
     */
    const MAX_WIDTH = 1024;

    /**
     * Array of image size limitation
     *
     * @var array
     */
    protected $_imageSize   = array(
        'minheight'     => self::MIN_HEIGHT,
        'minwidth'      => self::MIN_WIDTH,
        'maxheight'     => self::MAX_HEIGHT,
        'maxwidth'      => self::MAX_WIDTH,
    );

    /**
     * @var WriteInterface
     */
    protected $mediaDirectory;

    /**
     * @var Filesystem
     */
    protected $filesystem;

    /**
     * @var FileTransferFactory
     */
    protected $httpFactory;

    /**
     * File Uploader factory
     *
     * @var UploaderFactory
     */
    protected $_fileUploaderFactory;

    /**
     * File Uploader factory
     *
     * @var File
     */
    protected $_ioFile;

    /**
     * Store manager
     *
     * @var StoreManagerInterface
     */
    protected $_storeManager;

    /**
     * @param Context $context
     * @param ScopeConfigInterface $scopeConfig
     * @param Filesystem $filesystem
     * @param Size $fileSize
     * @param FileTransferFactory $httpFactory
     * @param UploaderFactory $fileUploaderFactory
     * @param File $ioFile
     * @param StoreManagerInterface $storeManager
     * @param Factory $imageFactory
     */
    public function __construct(
        Context $context,
        Filesystem $filesystem,
        Size $fileSize,
        FileTransferFactory $httpFactory,
        UploaderFactory $fileUploaderFactory,
        File $ioFile,
        StoreManagerInterface $storeManager,
        Factory $imageFactory
    ) {;
        $this->filesystem = $filesystem;
        $this->mediaDirectory = $filesystem->getDirectoryWrite(DirectoryList::MEDIA);
        $this->httpFactory = $httpFactory;
        $this->_fileUploaderFactory = $fileUploaderFactory;
        $this->_ioFile = $ioFile;
        $this->_storeManager = $storeManager;
        $this->_imageFactory = $imageFactory;
        parent::__construct($context);
    }

    /**
     * Remove news item image by image filename
     *
     * @param string $imageFile
     * @return bool
     */
    public function removeImage($imageFile)
    {
        $io = $this->_ioFile;
        $io->open(array('path' => $this->getBaseDir()));
        if ($io->fileExists($imageFile)) {
            return $io->rm($imageFile);
        }
        return false;
    }

    /**
     * Return URL for resized image
     *
     * @param string $imageFile
     * @param integer $width
     * @param integer $height
     * @return bool|string
     */
    public function resize($imageFile, $width, $height = null)
    {
        if ($width < self::MIN_WIDTH || $width > self::MAX_WIDTH) {
            return false;
        }
        $width = (int)$width;

        if (!is_null($height)) {
            if ($height < self::MIN_HEIGHT || $height > self::MAX_HEIGHT) {
                return false;
            }
            $height = (int)$height;
        }

        $cacheDir  = $this->getBaseDir() . '/' . 'cache' . '/' . $width;
        $cacheUrl  = $this->getBaseUrl() . '/' . 'cache' . '/' . $width . '/';

        $io = $this->_ioFile;
        $io->checkAndCreateFolder($cacheDir);
        $io->open(array('path' => $cacheDir));
        if ($io->fileExists($imageFile)) {
            return $cacheUrl . $imageFile;
        }

        try {
            $image = $this->_imageFactory->create($this->getBaseDir() . '/' . $imageFile);
            $image->resize($width, $height);
            $image->save($cacheDir . '/' . $imageFile);
            return $cacheUrl . $imageFile;
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * Upload image and return uploaded image file name or false
     *
     * @throws Exception
     * @param string $scope the request key for file
     * @return bool|string
     */
    public function uploadImage($scope)
    {

        $adapter = $this->httpFactory->create();
        $adapter->addValidator(new \Zend_Validate_File_ImageSize($this->_imageSize));
        $adapter->addValidator(
            new \Zend_Validate_File_FilesSize(['max' => self::MAX_FILE_SIZE])
        );

        if ($adapter->isUploaded($scope)) {
            if (!$adapter->isValid($scope)) {
                throw new Exception(__('Uploaded image is not valid.'));
            }

            $uploader = $this->_fileUploaderFactory->create(['fileId' => $scope]);
            $uploader->setAllowedExtensions(['jpg', 'jpeg', 'gif', 'png']);
            $uploader->setAllowRenameFiles(true);
            $uploader->setFilesDispersion(false);
            $uploader->setAllowCreateFolders(true);

            if ($uploader->save($this->getBaseDir())) {
                return self::MEDIA_PATH .'/'. $uploader->getUploadedFileName();
            }

        }
        return false;
    }

    /**
     * Return the base media directory for News Item images
     *
     * @return string
     */
    public function getBaseDir()
    {
        $path = $this->filesystem->getDirectoryRead(
            DirectoryList::MEDIA
        )->getAbsolutePath(self::MEDIA_PATH);

        return $path;
    }

    /**
     * Return the Base URL for images
     *
     * @return string
     */
    public function getBaseUrl()
    {
        return $this->_storeManager->getStore()->getBaseUrl(
                UrlInterface::URL_TYPE_MEDIA
            ) . '/' . self::MEDIA_PATH;
    }
}

<?php
/**
 * @author Pavel Usachev <webcodekeeper@hotmail.com>
 * @copyright Copyright (c) 2017, Pavel Usachev
 */

namespace SP\Slider\Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use SP\Slider\Api\Data\CarouselInterface;
use SP\Slider\Model\ResourceModel\Carousel\CollectionFactory;

class AltGenerationCommand extends Command
{
    protected $collectionFactory;

    /**
     * AltGenerationCommand constructor.
     * @param CollectionFactory $collectionFactory
     */
    public function __construct(CollectionFactory $collectionFactory)
    {
        $this->collectionFactory = $collectionFactory;
        parent::__construct();
    }

    public function configure()
    {
        $this->setName('sp:slider:alt_generation')
             ->setDescription('Generate alt for slider images');
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        foreach ($this->getCollection() as $item) {
            $image = $item->getImage();
            $alt = $item->getAlt();
            if ($input->getOption('verbose')) {
                $output->writeln("<comment>Processed:</comment> $image");
            }
        }

        $count = $this->getCollection()->count();

        $output->writeln("<info>Results:</info> $count");
    }

    /**
     * @return \SP\Slider\Model\ResourceModel\Carousel\Collection
     */
    protected function getCollection()
    {
        return $this->collectionFactory->create()->addFieldToFilter(CarouselInterface::CAROUSEL_ALT, [
            'notnull' => true
        ]);
    }

}

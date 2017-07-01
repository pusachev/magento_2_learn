<?php
/**
 * @author Pavel Usachev <webcodekeeper@hotmail.com>
 * @copyright Copyright (c) 2017, Pavel Usachev
 */

namespace SP\Slider\Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;

use SP\Slider\Api\Data\CarouselInterface;
use SP\Slider\Model\CarouselFactory;

class AddSliderItemCommand extends Command
{
    protected $carouselFactory;

    protected $helper;

    public function __construct(CarouselFactory $carouselFactory)
    {
        $this->carouselFactory = $carouselFactory;
        parent::__construct();
    }

    public function configure()
    {
        $this->setName('sp:slider:add_item')
             ->setDescription('Add slider item');
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $data = [];

        foreach ($this->getQuestionList() as $field => $question) {
            $value = $this->getQuestion($question, $input, $output);
            $data[$field] = $value;
        }

        try {
            $this->carouselFactory->create()->setData($data)->save();
            $output->writeln("<info>Item saved success</info>");
        } catch (\Exception $e) {
            $error = $e->getMessage();
            $output->writeln("<error>$error</error>");
        }
    }

    protected function getQuestion($question, $input, $output, $default = null)
    {
        $question = new Question($question, $default);

        return $this->getHelper('question')->ask($input, $output, $question);
    }

    public function getQuestionList()
    {
        return [
            CarouselInterface::CAROUSEL_IMAGE => 'Input image file: ',
            CarouselInterface::CAROUSEL_ALT => 'Input image alt: '
        ];
    }
}

<?php
/**
 * Created by PhpStorm.
 * User: alfon
 * Date: 6/16/2019
 * Time: 13:02
 */

namespace App\Command;


use App\Entity\Product;
use App\Entity\Sales;
use Doctrine\ORM\EntityManagerInterface;
use phpDocumentor\Reflection\DocBlock\Tags\Property;
use phpDocumentor\Reflection\Types\This;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class SetupCommand extends Command
{

    /** @var EntityManagerInterface */
    private $entityManager;

    /** @var string */
    private $projectDir;

    /** @var array */
    private $products = [];

    /**
     * SetupCommand constructor.
     * @param EntityManagerInterface $entityManager
     * @param string $projectDir
     */
    public function __construct(EntityManagerInterface $entityManager, string $projectDir)
    {
        $this->projectDir = $projectDir;
        $this->entityManager = $entityManager;
        parent::__construct();
    }

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('flinders:data:setup')
            ->setDescription('Initialize the database');
    }

    /**
     * Get a product by name
     *
     * @param string $name
     * @return mixed
     */
    private function getProductByName(string $name)
    {
        $product = null;
        if (!isset($this->products[$name])) {
            $product = new Product();
            $product->setName($name);
            $this->products[$name] = $product;
            $this->entityManager->persist($product);
        }
        return $this->products[$name];
    }

    /**
     * Store a new sales record
     *
     * @param array $data
     */
    private function newSales(array $data)
    {
        // TODO: check values, we won't need to since we have full control over our input
        $sales = new Sales();
        $sales
            ->setProduct($this->getProductByName($data[0]))
            ->setPrice((float)$data[1])
            ->setQuantity((int)$data[2])
            ->setDate(\DateTime::createFromFormat('Y-m-d', $data[3]));
        $this->entityManager->persist($sales);
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {

        $filename = $this->projectDir . '/assets/sales.csv';
        $firstLine = true;
        if (($handle = fopen($filename, "r")) !== false) {
            while (($data = fgetcsv($handle, 1000, ";")) !== false) {
                if (!$firstLine) {
                    $this->newSales($data);
                }
                $firstLine = false;
            }
            fclose($handle);
        }
        $this->entityManager->flush();
    }
}
<?php
/**
 * Copyright © MageKey. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Betzal\GetImagesRole\Console\Command;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Catalog\Model\ProductFactory;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;
use Magento\Eav\Model\Config;
use Magento\Framework\App\State;
use Magento\Catalog\Api\ProductRepositoryInterface;

class GetImagesRole extends \Symfony\Component\Console\Command\Command
{
    /**
     * @var \Magento\CatalogUrlRewrite\Model\CategoryUrlPathGenerator
     */
    private $categoryUrlPathGenerator;

    /**
     * @var CategoryResource
     */
    protected $categoryResource;

    /**
     * @var StoreManagerInterface
     */
    protected $storeManager;

    protected $_categoryCollectionFactory;

    protected $_productCollection;

    protected $productFactory;

    protected $eavConfig;

    protected $state;

    protected $productRepository;

    /**
     * UpdateCategoryUrlPath constructor.
     */
    public function __construct(CollectionFactory $collectionFactory,
                                StoreManagerInterface $storeManager,
                                ProductFactory $productFactory,
                                Config $eavConfig,
                                State $state,
                                ProductRepositoryInterface $productRepository)
    {
        $this->_productCollection = $collectionFactory;
        $this->storeManager = $storeManager;
        $this->productFactory = $productFactory;
        $this->eavConfig = $eavConfig;
        $this->state = $state;
        $this->productRepository = $productRepository;
        parent::__construct();
    }

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this->setName('betzal:product:setimagerole')
            ->setDescription('Get image roles');
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->state->setAreaCode(\Magento\Framework\App\Area::AREA_FRONTEND);
        $productCollection = $this->_productCollection->create();
        $productCollection->addAttributeToSelect('*');
        try
        {
            foreach ($productCollection as $product)
            {
                if ($product->getSku() == '1')
                {
                    $productDetails = $this->productRepository->get($product->getSku(), true);
                    $images = $productDetails->getMediaGalleryImages();
                    $output->writeln(__(sprintf('Product ------ %s', $productDetails->getName())));
                    foreach ($images as $image) {
                        /**
                         * Set custom image role created for an image
                         * This will set the custom role for the last image in the list
                         */
                        $productDetails->setData('custom_role_1', $image->getFile());
                        $output->writeln(__(sprintf('Image - %s', $image->getFile())));
                    }
                    $this->productRepository->save($productDetails);
                }
            }
            $output->writeln("<info>Finished Checking.</info>");
        }
        catch (\Exception $e)
        {
            $output->writeln("<error>" . $e->getMessage() . "</error>");
        }
    }
}

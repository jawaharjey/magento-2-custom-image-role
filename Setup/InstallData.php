<?php

namespace Betzal\GetImagesRole\Setup;

use Magento\Catalog\Model\ResourceModel\Product as ResourceProduct;
use Magento\Eav\Model\Entity\Attribute\Set as AttributeSet;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class InstallData implements InstallDataInterface
{
    protected $_attributeSet;
    protected $eavSetupFactory;
    protected $_resourceProduct;

    public function __construct(
        AttributeSet $attributeSet,
        EavSetupFactory $eavSetupFactory,
        ResourceProduct $resourceProduct,
        \Magento\Framework\File\Size $fileSize
    ) {
        $this->_attributeSet = $attributeSet;
        $this->eavSetupFactory = $eavSetupFactory;
        $this->_resourceProduct = $resourceProduct;
    }

    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);
        $eavSetup->addAttribute(
            \Magento\Catalog\Model\Product::ENTITY,
            'custom_role_1',
            [
                'type' => 'varchar',
                'frontend' => '\Magento\Catalog\Model\Product\Attribute\Frontend\Image',
                'backend' => '',
                'label' => 'Custom Role 1',
                'input' => 'media_image',
                'class' => '',
                'source' => '',
                'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
                'visible' => true,
                'required' => false,
                'user_defined' => false,
                'default' => '',
                'searchable' => false,
                'filterable' => false,
                'comparable' => false,
                'visible_on_front' => false,
                'unique' => false,
            ]
        );
        $eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);
        $eavSetup->addAttribute(
            \Magento\Catalog\Model\Product::ENTITY,
            'custom_role_2',
            [
                'type' => 'varchar',
                'frontend' => '\Magento\Catalog\Model\Product\Attribute\Frontend\Image',
                'backend' => '',
                'label' => 'Custom Role 2',
                'input' => 'media_image',
                'class' => '',
                'source' => '',
                'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
                'visible' => true,
                'required' => false,
                'user_defined' => false,
                'default' => '',
                'searchable' => false,
                'filterable' => false,
                'comparable' => false,
                'visible_on_front' => false,
                'unique' => false,
            ]
        );
    }

}

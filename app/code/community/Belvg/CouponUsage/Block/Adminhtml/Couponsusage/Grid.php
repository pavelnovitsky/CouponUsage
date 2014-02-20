<?php
/**
 * @category   Belvg
 * @package    Belvg_CouponUsage
 * @author Pavel Novitsky <pavel@belvg.com>
 * @copyright  Copyright (c) 2010 - 2012 BelVG LLC. (http://www.belvg.com)
 */

class Belvg_CouponUsage_Block_Adminhtml_Couponsusage_Grid extends Mage_Adminhtml_Block_Widget_Grid
{

    /**
     * Init sorting
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->setId('couponsusageGrid');
        $this->setDefaultDir('ASC');
        $this->setSaveParametersInSession(TRUE);
    }

    /**
     * Prepare grid collection
     *
     * @return Mage_Adminhtml_Block_Widget_Grid
     */
    protected function _prepareCollection()
    {
        $collection = Mage::getModel('sales/order')->getCollection();
        $collection->addAttributeToFilter('coupon_code', array('notnull' => TRUE));
        $collection->addAttributeToFilter('coupon_code', array('neq' => ''));

        $collection->getSelect()->joinLeft( array('salesrule_coupon'=>$collection->getTable('salesrule/coupon')), 'main_table.coupon_code = salesrule_coupon.code', array('salesrule_coupon.rule_id'));
        $collection->getSelect()->joinLeft( array('salesrule_rule'=>$collection->getTable('salesrule/rule')), 'salesrule_coupon.rule_id = salesrule_rule.rule_id', array('salesrule_rule.name'));

        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    /**
     * Prepare grid columns
     *
     * @return Mage_Adminhtml_Block_Widget_Grid
     */
    protected function _prepareColumns()
    {
        $this->addColumn('coupon_code', array(
                'header' => Mage::helper('salesrule')->__('Coupon Code'),
                'align' => 'left',
                'index' => 'coupon_code',
        ));

        $this->addColumn('name', array(
                'header' => Mage::helper('salesrule')->__('Rule Name'),
                'align' => 'left',
                'index' => 'name',
                'renderer' => $this->_isExport?'':'belvg_couponusage/adminhtml_couponsusage_grid_renderer_rule',
                'filter_index' => 'salesrule_rule.name'
        ));

        $this->addColumn('increment_id', array(
                'header' => Mage::helper('sales')->__('Order #'),
                'align' => 'left',
                'index' => 'increment_id',
                'renderer' => $this->_isExport?'':'belvg_couponusage/adminhtml_couponsusage_grid_renderer_incrementid',
        ));

        $this->addColumn('created_at', array(
                'header' => Mage::helper('sales')->__('Purchased On'),
                'index' => 'created_at',
                'type' => 'datetime',
                'align' => 'left',
                'filter_index' => 'main_table.created_at'
        ));

        $this->addColumn('grand_total', array(
                'header' => Mage::helper('sales')->__('G.T. (Purchased)'),
                'index' => 'grand_total',
                'type' => 'currency',
                'currency' => 'order_currency_code',
        ));

        $this->addColumn('status', array(
                'header' => Mage::helper('sales')->__('Status'),
                'align' => 'right',
                'index' => 'status',
                'type' => 'options',
                'options' => Mage::getSingleton('sales/order_config')->getStatuses(),
        ));

        $this->addExportType('*/*/exportCsv', Mage::helper('salesrule')->__('CSV'));
        $this->addExportType('*/*/exportXml', Mage::helper('salesrule')->__('XML'));
        return parent::_prepareColumns();
    }

    /**
     * Get row url
     *
     * @param Varien_Object $row
     * @return string
     */
    public function getRowUrl($row)
    {
        return FALSE;
    }

}
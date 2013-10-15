<?php

/**
 * @category    Belvg
 * @package     Belvg_CouponUsage
 * @author      Pavel Novitsky <pavel@belvg.com>
 * @copyright   2010 - 2013 BelVG LLC. (http://www.belvg.com)
 */

class Belvg_CouponUsage_Block_Adminhtml_Couponsusage extends Mage_Adminhtml_Block_Widget_Grid_Container
{

    /**
     * Define block
     *
     * @return void
     */
    public function __construct()
    {
        $this->_controller = 'adminhtml_couponsusage';
        $this->_blockGroup = 'belvg_couponusage';
        $this->_headerText = Mage::helper('belvg_couponusage')->__('Coupons Usage');

        parent::__construct();
        $this->removeButton('add');
    }

}
<?php

/**
 * @category    Belvg
 * @package     Belvg_CouponUsage
 * @author      Pavel Novitsky <pavel@belvg.com>
 * @copyright   2010 - 2013 BelVG LLC. (http://www.belvg.com)
 */

/**
 * Coupon usage admin controller
 */
class Belvg_CouponUsage_Adminhtml_CouponsusageController extends Mage_Adminhtml_Controller_Action
{

    /**
     * Check ACL rules
     *
     * @return bool
     */
    protected function _isAllowed()
    {
        return Mage::getSingleton('admin/session')
                        ->isAllowed('promo/belvg_couponusage');
    }

    /**
     * Set page title
     *
     * @return Belvg_CouponsUsage_Adminhtml_CouponsUsageController
     */
    protected function _initAction()
    {
        $this->loadLayout()
                ->_setActiveMenu('promo/belvg_couponusage')
                ->_addBreadcrumb(Mage::helper('adminhtml')->__('Promotions'), Mage::helper('belvg_couponusage')->__('Coupons Usage'))
                ->_title(Mage::helper('belvg_couponusage')->__('Coupons Usage'));
        return $this;
    }

    /**
     * Display grid
     */
    public function indexAction()
    {
        $this->_initAction();
        $this->renderLayout();
    }

    /**
     * Export coupons grid to CSV format
     */
    public function exportCsvAction()
    {
        $fileName = 'CouponUsage.csv';
        $content = $this->getLayout()->createBlock('belvg_couponusage/adminhtml_couponsusage_grid');
        $this->_prepareDownloadResponse($fileName, $content->getCsvFile());
    }

    /**
     * Export coupons grid to XML format
     */
    public function exportXmlAction()
    {
        $fileName = 'CouponUsage.xml';
        $content = $this->getLayout()->createBlock('belvg_couponusage/adminhtml_couponsusage_grid');

        $this->_prepareDownloadResponse($fileName, $content->getExcelFile());
    }

}
<?php

/**
 * @category    Belvg
 * @package     Belvg_CouponUsage
 * @author      Pavel Novitsky <pavel@belvg.com>
 * @copyright   2010 - 2013 BelVG LLC. (http://www.belvg.com)
 */

/**
 * Discount rule name link renderer
 */
class Belvg_CouponUsage_Block_Adminhtml_Couponsusage_Grid_Renderer_Rule
    extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{

    public function render(Varien_Object $row)
    {
        $rule_id = $row->getRuleId();
        $name = $row->getName();

        $rule_url = $this->getUrl('adminhtml/promo_quote/edit', array('id' => $rule_id));
        return sprintf('<a href="%s">%s</a>', $rule_url, $name);
    }

}

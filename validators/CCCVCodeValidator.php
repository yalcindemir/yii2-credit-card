<?php
/**
 * @copyright Copyright &copy; 2015 Andrew Blake
 * @package andrewblake1\yii2-credit-card
 * @license http://opensource.org/licenses/MIT MIT License
 * @link https://github.com/andrewblake1/yii2-credit-card
 * @version 0.0.1
 */
namespace andrewblake1\creditcard\validators;

use yii\validators\Validator;
use yii\web\JsExpression;
use Yii;

/**
 * Yii2 Validator to validator CVC/CVV/CVS credit card attribute in client on blur using $.payment.validateCardCVC from
 * https://github.com/stripe/jquery.payment and working with ActiveForm (yii.activeform.js).
 *
 * @author Andrew Blake <admin@newzealandfishing.com>
 */
class CCCVCodeValidator extends Validator
{
    public function init()
    {
        parent::init();
        $this->message = Yii::t('creditcard', 'Invalid CV code.');
    }

    public function clientValidateAttribute($model, $attribute, $view)
    {
        $message = json_encode($this->message, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
        return new JsExpression("
            if (!$.payment.validateCardCVC(value)) {
                messages.push($message);
            }
        ");
    }
}
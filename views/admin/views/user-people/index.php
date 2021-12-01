<?php
/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2021 HumHub GmbH & Co. KG
 * @license https://www.humhub.com/licences
 */

use humhub\libs\Html;
use humhub\modules\admin\models\forms\PeopleSettingsForm;
use humhub\modules\ui\form\widgets\ActiveForm;
use humhub\widgets\Button;

/* @var $model PeopleSettingsForm */
?>

<div class="panel-body">

    <h4><?= Yii::t('AdminModule.user', 'People'); ?></h4>

    <br />

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'defaultSorting')->dropDownList(PeopleSettingsForm::getSortingOptions()); ?>
    <div id="defaultSortingGroupSelector"<?php if ($model->defaultSorting !== '') : ?> style="display:none"<?php endif; ?>>
        <?= $form->field($model, 'defaultSortingGroup')->dropDownList(PeopleSettingsForm::getSortingGroupOptions()); ?>
    </div>

    <?= Button::save(Yii::t('AdminModule.user', 'Save'))->submit(); ?>

    <?php ActiveForm::end(); ?>
</div>
<script <?= Html::nonce() ?>>
$('select[name="PeopleSettingsForm[defaultSorting]"]').change(function(){
    $('#defaultSortingGroupSelector').toggle($(this).val() === '');
})
</script>
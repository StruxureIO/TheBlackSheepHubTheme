<?php
/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2021 HumHub GmbH & Co. KG
 * @license https://www.humhub.com/licences
 */

use humhub\libs\Html;
use humhub\modules\user\models\User;
use humhub\modules\user\widgets\PeopleActionButtons;
use humhub\modules\user\widgets\Image;
use humhub\modules\user\widgets\PeopleDetails;
use humhub\modules\user\widgets\PeopleIcons;
use humhub\modules\user\widgets\PeopleTagList;
use yii\web\View;
use yii\helpers\Url;
use humhub\modules\ui\icon\widgets\Icon;


/* @var $this View */
/* @var $user User */

$user_profile = $user->profile;
$spoken_languges = $user_profile->language_spoken;

$categories = $user->profile->getProfileFieldCategories();
$tags = [];


    foreach ($categories as $category) {
        foreach ( $user->profile->getProfileFields($category) as $field ) {
            $field_title = $field->title;
            $field_value = $field->getUserValue($user, true);
            if ($field_title == "List property for sellers" AND $field_value){
                array_push($tags, "Lists properties");
            }
            if ($field_title == "Pay referral fees for listings" AND $field_value){
                array_push($tags, "Listing referrals");
            }
            if ($field_title == "Work with buyers" AND $field_value){
                array_push($tags, "Works with buyers");
            }
            if ($field_title == "Pay referral fees for buyers" AND $field_value){
                array_push($tags, "Buyer referrals");
            }
            if ($field_title == "Looking for deals for wholesalers" AND $field_value){
                array_push($tags, "Looking for deals for wholesalers");
            }
            if ($field_title == "Partnering" AND $field_value){
                array_push($tags, "Partnering");
            }
            if ($field_title == "Lending" AND $field_value){
                array_push($tags, "Lending");
            }
            if ($field_title == "Mentor - Listing Property" AND $field_value){
                array_push($tags, "Listing Mentor");
            }
            if ($field_title == "Mentor - Working With Buyers" AND $field_value){
                array_push($tags, "Buyers Mentor");
            }
            if ($field_title == "Mentor - Investing" AND $field_value){
                array_push($tags, "Investing Mentor");
            }
        }
    }


?>


<div class="card-panel">
    <div class="card-bg-image"<?php if ($user->getProfileBannerImage()->hasImage()) : ?> style="background-image: url('<?= $user->getProfileBannerImage()->getUrl() ?>')"<?php endif; ?>></div>
    <div class="card-header">
        <?= Image::widget([
            'user' => $user,
            'htmlOptions' => ['class' => 'card-image-wrapper'],
            'linkOptions' => ['data-contentcontainer-id' => $user->contentcontainer_id, 'class' => 'card-image-link'],
            'width' => 94,
        ]); ?>
        <?php /*<div class="card-icons">
            <?= PeopleIcons::widget(['user' => $user]); ?>
        </div> */ ?>
    </div>
    <div class="card-body">
        <strong class="card-title"><?= Html::containerLink($user); ?></strong></br>

        <?php if($user_profile->market):?>
                <span class="card-details">
                    <?= Icon::get('map-pin')?>
                    <?= $user_profile->market ?>
                </span>
                <?php endif?>

                <?php if($user_profile->language_spoken):?>
                <span class="card-details">
                <?= Icon::get('comment')?>
                <?= $spoken_languges ?>
                </span>
                <?php endif?>

                <?php if($user_profile->lending):?>
                <span class="card-details">
                <?= Icon::get('hand-holding-usd')?>
                Lending
                </span>
                <?php endif?>

                <?php if($user_profile->license_date):?>
                <strong><?= $years_licensed ?></strong> Years licensed
        <?php endif?>

        <?php if (count($tags)) : ?>
        
        
                <!-- start: tags for user skills -->
                <div class="card-tags">
                    <?php foreach ($tags as $tag): ?>
                        <?php echo Html::a(Html::encode($tag), Url::to(['/user/people', 'keyword' => $tag]), ['class' => 'btn btn-default btn-xs tag']); ?>
                    <?php endforeach; ?>
                </div>
                <!-- end: tags for user skills -->

        <script <?= \humhub\libs\Html::nonce() ?>>
            function toggleUp() {
                $('.pups').slideUp("fast", function () {
                    // Animation complete.
                    $('#collapse').hide();
                    $('#expand').show();
                });
            }

            function toggleDown() {
                $('.pups').slideDown("fast", function () {
                    // Animation complete.
                    $('#expand').hide();
                    $('#collapse').show();
                });
            }
        </script>

        <?php endif; ?>



    </div>
    <?= PeopleActionButtons::widget([
        'user' => $user,
        'template' => '<div class="card-footer">{buttons}</div>',
    ]); ?>
</div>
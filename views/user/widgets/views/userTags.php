<?php

use yii\helpers\Html;
use yii\helpers\Url;

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
<?php if (count($tags)) : ?>
 
    <div id="user-tags-panel" class="panel panel-default" style="position: relative;">

        <?php echo \humhub\widgets\PanelMenu::widget(['id' => 'user-tags-panel']); ?>

        <div class="panel-heading"><?php echo Yii::t('UserModule.base', '<strong>Agent</strong> tags'); ?></div>
        <div class="panel-body">
            <!-- start: tags for user skills -->
            <div class="card-tags">
                <?php foreach ($tags as $tag): ?>
                    <?php echo Html::a(Html::encode($tag), Url::to(['/user/people', 'keyword' => $tag]), ['class' => 'btn btn-default btn-xs tag']); ?>
                <?php endforeach; ?>
            </div>
            <!-- end: tags for user skills -->

        </div>
    </div>
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
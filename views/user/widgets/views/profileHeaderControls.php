<?php

use humhub\modules\user\widgets\ProfileHeaderControls;
use humhub\modules\friendship\widgets\FriendshipButton;
use humhub\modules\user\widgets\ProfileEditButton;
use humhub\modules\user\widgets\ProfileHeaderCounterSet;
use humhub\modules\user\widgets\UserFollowButton;
use humhub\modules\user\models\User;
use humhub\modules\ui\icon\widgets\Icon;

//$user = Yii::$app->user->getIdentity();
// // Default email not used ATM Need to find user for profile not app user like above $user
// $categories = $user->profile->getProfileFieldCategories();
// foreach ($categories as $category) {
//     $fields = $user->profile->getProfileFields($category);
//     foreach ($fields as $field){

//         // print_r($field);

//         $fieldTitle = $field->title;

//         if ($fieldTitle == 'E-Mail'){

//             $email = $field->getUserValue($user, true);
//             echo ($email);
            
//         }
//     }
// }


/* @var $container \humhub\modules\content\components\ContentContainerActiveRecord */
$user_profile = $this->context->container->profile;
$captain_status = $user_profile->captain_status;
$spoken_languges = $user_profile->language_spoken;
//calculate years licensed
$years_licensed = floor((strtotime("now")-strtotime($user_profile->license_date))/31556952);


?>
<div class="panel-body">
    <div class="panel-profile-controls">
        <div class="row">
            <div class="col-md-12">

                <?php if($user_profile->market):?>
                <span class="agent-header-list agent-header-market">
                    <?= Icon::get('map-pin')?>
                    <strong><?= $user_profile->market ?></strong>
                </span>
                <?php endif?>
                
                <?php if($captain_status):?>
                <span class="agent-header-list agent-header-captain">
                <?= Icon::get('crown')?>
                <strong>Captain</strong>
                </span>
                <?php endif?>

                <?php if($user_profile->language_spoken):?>
                <span class="agent-header-list agent-header-language">
                <?= Icon::get('comment')?>
                <strong><?= $spoken_languges ?></strong>
                </span>
                <?php endif?>

                <?php if($user_profile->lending):?>
                <span class="agent-header-list agent-header-lending">
                <?= Icon::get('hand-holding-usd')?>
                <strong>Lending</strong>
                </span>
                <?php endif?>

                <?php if($user_profile->license_date):?>
                <strong><?= $years_licensed ?></strong> Years licensed
                <?php endif?>

                <div class="controls controls-header pull-right">
                    <?= ProfileHeaderControls::widget([
                        'user' => $container,
                        'widgets' => [
                            [ProfileEditButton::class, ['user' => $container], []],
                            [UserFollowButton::class, ['user' => $container], []],
                            [FriendshipButton::class, ['user' => $container], []],
                        ]
                    ]);
                    ?>
                </div>
            </div>
        </div>
        
        <?php if($user_profile->about):?>
        <div class="row agent-about">
            <div class="col-md-8">
            <?= $user_profile->about ?>
            </div>
        </div>
        <?php endif?>

        <?php if($user_profile->phone_private):?>
        <div class="row agent-phone-email">
            <div class="col-md-8">
            <span class="agent-phone"><strong><?= $user_profile->phone_private ?></span><a href="mailto:<?= $user_profile->public_email ?>" class="agent-email"><?= $user_profile->public_email ?></a></strong>
            </div>
        </div>
        <?php endif?>
        
    </div>
</div>
<div>

</div>



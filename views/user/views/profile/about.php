<?php

use humhub\modules\content\widgets\richtext\RichText;
use yii\helpers\Html;
use humhub\modules\user\models\fieldtype\MarkdownEditor;
use humhub\widgets\MarkdownView;

use humhub\modules\friendship\widgets\FriendsPanel;
use humhub\modules\post\widgets\Form;
use humhub\modules\user\models\User;
use humhub\modules\user\widgets\ProfileSidebar;
use humhub\modules\user\widgets\StreamViewer;
use humhub\modules\user\widgets\UserFollower;
use humhub\modules\user\widgets\UserSpaces;
use humhub\modules\user\widgets\UserTags;

/**
 * @var $this \humhub\modules\ui\view\components\View
 * @var $user \humhub\modules\user\models\User
 */
$categories = $user->profile->getProfileFieldCategories();

//bold the first word in category title
function formatCategoryHeader($category_name){
    $header_arry = explode(' ', $category_name);
    $formated_header = '';
    for ($i = 0; $i < count($header_arry); $i++) {
        if ($i == 0){
            $formated_header = "<strong>".$header_arry[0]."</strong>";
        }
        else {
            $formated_header = $formated_header." ".strtolower($header_arry[$i]);
        }
    }
    echo $formated_header;
}

?>

<div class="panel panel-default profile-about-panel">

    <?php foreach ($categories as $category) :?>
        <?php $category_title = $category->title;?>
            <?php if($category_title == "StepStone" || $category_title == "General" || $category_title == "Communication" || $category_title == "StepStone - Locked"): ?>
            <?php else: ?>
                <div id="profile-category-<?= $category->id ?>">
                
                <div class="panel-heading"><?php formatCategoryHeader($category_title);?></div>
                <hr/>
                    <form class="form-horizontal" role="form">
                        <?php foreach ($user->profile->getProfileFields($category) as $field) : ?>

                            <div class="form-group">
                                <label class="col-sm-6 control-label">
                                    <?= $field->title ?>
                                </label>
                                    <div class="col-sm-6">
                                    <p class="form-control-static"><?= $field->getUserValue($user, false) ?></p>
                                    </div>
                            </div>
                        <?php endforeach; ?>
                    </form>
                </div>
            
            <?php endif; ?>
        <?php endforeach; ?>

    <?php $this->beginBlock('sidebar'); ?>
    <?=
    ProfileSidebar::widget([
        'user' => $user,
        'widgets' => [
            [UserTags::class, ['user' => $user], ['sortOrder' => 10]],
            [UserSpaces::class, ['user' => $user], ['sortOrder' => 20]],
            [FriendsPanel::class, ['user' => $user], ['sortOrder' => 30]],
            [UserFollower::class, ['user' => $user], ['sortOrder' => 40]],
        ]
    ]);
    ?>
    <?php $this->endBlock(); ?>
           
</div>





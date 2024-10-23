<?php require_once('../../../private/initialize.php'); ?>

<?php
    //$id = isset($_GET['id']) ? $_GET['id'] = '1';
    $id = $_GET['id'] ?? '1';

    $subject = find_subject_by_id($id);
?>

<?php $page_title='Show Subject';?>
<?php include(SHARED_PATH . '/staff_header.php');?>

<div id="content">
    <a href="<?php echo url_for('/staff/subjects/index.php');?>" class="back-link">&laquo; Back to List</a>
    <div class="subject show">
        <h1>Subject: <?php echo h($subject['menu_name']);?></h1>

        <div class="attribute">
            <dl>
                <dt>Menu Name</dt>
                <dd><?php echo h($subject['menu_name']);?></dd>
            </dl>
            <dl>
                <dt>Position</dt>
                <dd><?php echo h($subject['position']);?></dd>
            </dl>
            <dl>
                <dt>Visible</dt>
                <dd><?php echo $subject['visible'] == '1' ? 'true' : 'false';?></dd>
            </dl>
        </div>
    </div>
</div>
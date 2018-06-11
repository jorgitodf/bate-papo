<!DOCTYPE html>
<html>
<head>
    <title>Chat</title>
    <meta charset="utf-8" name="viewport" content="width=device-width,initial-scale=1"/>
    <link href="<?php echo BASE_URL; ?>assets/css/style.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/jquery-3.3.1.min.js"></script>
</head>
<body>
    <?php $this->loadViewInTemplate($viewName, $viewData); ?>
    <div class="modal_bg" style="display:none">
        <div class="modal_area">
            ...
        </div>
    </div>

    <script type="text/javascript">
        var BASE_URL = '<?php echo BASE_URL; ?>';
    </script>
    <script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/chat.js"></script>
    <script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/script.js"></script>
</body>
</html>



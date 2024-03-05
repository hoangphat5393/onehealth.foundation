<script type="text/javascript" src="<?php echo e(asset('plugin/ckfinder/ckfinder.js')); ?>"></script>
<script>
    CKFinder.config({
        connectorPath: <?php echo json_encode(route('ckfinder_connector'), 15, 512) ?>
    });
</script>
<?php /**PATH F:\web\onehealth.foundation\resources\views/vendor/ckfinder/setup.blade.php ENDPATH**/ ?>
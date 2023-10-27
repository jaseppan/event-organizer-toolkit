<?php
/**
 * Partial for textareas
 */
?>

<div class="form-field <?php echo (isset($field['container-classes'])) ? $field['container-classes'] : '' ?>">
    <label for="<?php echo $field['name'] ?>"><?php echo $field['label'] ?></label>
    <textarea id="<?php echo $field['name'] ?>" name="<?php echo $field['name'] ?>" rows="4"></textarea>
</div>
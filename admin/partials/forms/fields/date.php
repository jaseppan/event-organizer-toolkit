<?php
/**
 * Partial suitaple for text, number, hidden... fields
 */
?>

<div class="form-field <?php echo (isset($field['container-classes'])) ? $field['container-classes'] : '' ?>">
    <label for="<?php echo $field['name'] ?>"><?php echo $field['label'] ?></label>
    <input class="eot-datepicker" type="text" id="<?php echo $field['name'] ?>" name="<?php echo $field['name'] ?>" <?php echo (isset($field['attributes'])) ? $field['attributes'] : '' ?>>
</div>
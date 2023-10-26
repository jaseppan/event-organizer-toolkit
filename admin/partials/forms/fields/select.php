<?php
/**
 * Partial suitaple for select fields
 */
?>

<div class="form-field <?php echo (isset($field['container-classes'])) ? $field['container-classes'] : '' ?>">
    <label for="<?php echo $field['name'] ?>"><?php echo $field['label'] ?></label>
    <select id="<?php echo $field['name'] ?>" name="<?php echo $field['name'] ?>" <?php echo (isset($field['attributes'])) ? $field['attributes'] : '' ?>>

        <?php foreach ($field['options'] as $key => $value) : ?>
            <option value="<?php echo $key ?>" <?php echo (isset($field['value']) && $field['value'] == $key
                ) ? 'selected' : '' ?>><?php echo $value ?></option>
        <?php endforeach ?>
    </select>
</div>
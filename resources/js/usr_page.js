const $selects = $(".candidate-select");
$selects.on('change', function(evt) {
    // create empty array to store the selected values
    const selectedValue = [];
    // get all selected options and filter them to get only options with value attr (to skip the default options). After that push the values to the array.
    $selects.find(':selected').filter(function(idx, el) {
        return $(el).attr('value');
    }).each(function(idx, el) {
        selectedValue.push($(el).attr('value'));
    });
    // loop all the options
    $selects.find('option').each(function(idx, option) { 
        // if the array contains the current option value otherwise we re-enable it.
        if (selectedValue.indexOf($(option).attr('value')) > -1) {
            // if the current option is the selected option, we skip it otherwise we disable it.
            if ($(option).is(':checked')) {
                return;
            } else {
                $(this).attr('disabled', true);
            }
        } else {
            $(this).attr('disabled', false);
        }
    });
});
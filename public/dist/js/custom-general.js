const urlLang = window.location.href.includes('/ar/') ? 'ar' : 'en',
    subFolderURL = "{{ env('sub_Folder_URL', '') }}";

/* Start configure toastr options*/
toastr.options = {
    'closeButton': true,
    'progressBar': true,
    "positionClass": urlLang == 'en' ? "toast-top-right" : "toast-top-left",
    'timeOut': '10000',
    'extendedTimeOut': '10000',
};
/* End configure toastr options */

/* Start Serialize form as Associative array */
$.fn.serializeAssoc = function () {
    var data = {};
    $.each(this.serializeArray(), function (key, obj) {
        var a = obj.name.match(/(.*?)\[(.*?)\]/);
        if (a !== null) {
            var subName = a[1];
            var subKey = a[2];

            if (!data[subName]) {
                data[subName] = [];
            }

            if (!subKey.length) {
                subKey = data[subName].length;
            }

            if (data[subName][subKey]) {
                if ($.isArray(data[subName][subKey])) {
                    data[subName][subKey].push(obj.value);
                } else {
                    data[subName][subKey] = [];
                    data[subName][subKey].push(obj.value);
                }
            } else {
                data[subName][subKey] = obj.value;
            }
        } else {
            if (data[obj.name]) {
                if ($.isArray(data[obj.name])) {
                    data[obj.name].push(obj.value);
                } else {
                    data[obj.name] = [];
                    data[obj.name].push(obj.value);
                }
            } else {
                data[obj.name] = obj.value;
            }
        }
    });
    return data;
};
/* End Serialize form as Associative array */

/*Start Send checkbox with 0 if not selected via add input hidden after this checkbox with target name and checkbox with no name */
$('[type="checkbox"]').on('change', function () {
    if ($(this).prop("checked")) {
        $(this).next().val(1);
    } else {
        $(this).next().val(0);
    }
})
/*End Send checkbox with 0 if not selected via add input hidden after this checkbox with target name and checkbox with no name */

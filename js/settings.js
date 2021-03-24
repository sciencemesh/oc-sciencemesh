(function ($, OC) {

    $(document).ready(function () {
        OCA.ScienceMesh = _.extend({
            AppName: "sciencemesh"
        }, OCA.ScienceMesh)


        $("#sciencemeshSave").click(function () {
            $(".section-sciencemesh").addClass("icon-loading");
            var apiKey = $("#sciencemeshAPIKey").val().trim();
            var sitename = $("#sciencemeshSitename").val().trim();
            var siteurl = $("#sciencemeshSiteurl").val().trim();
            var countryCode = $("#sciencemeshCountryCode").val().trim();
            var iopurl = $("#sciencemeshIopUrl").val().trim();
            var numUsers = $("#sciencemeshNumusers").val().trim();
            var numFiles = $("#sciencemeshNumfiles").val().trim();
            var numStorage = $("#sciencemeshNumstorage").val().trim();

            $.ajax({
                method: "PUT",
                url: OC.generateUrl("apps/" + OCA.ScienceMesh.AppName + "/ajax/settings/address"),
                data: {
                    apikey: apiKey,
                    sitename: sitename,
                    siteurl: siteurl,
                    country: countryCode,
                    iopurl: iopurl,
                    numusers: numUsers,
                    numfiles: numFiles,
                    numstorage: numStorage
                },
                success: function onSuccess(response) {
                    $(".section-sciencemesh").removeClass("icon-loading");
                    if (response && (response.iopUrl != null)) {
                        $("#sciencemeshIopUrl").val(response.iopurl);
                        $("#sciencemeshApiKey").val(response.apikey);

                        var message =
                            response.error
                                ? (t(OCA.ScienceMesh.AppName, "Error when trying to connect") + " (" + response.error + ")")
                                : t(OCA.ScienceMesh.AppName, "Settings have been successfully updated");

                        var versionMessage = response.version ? (" (" + t(OCA.ScienceMesh.AppName, "version") + " " + response.version + ")") : "";

                        OC.Notification.show(message + versionMessage, {
                            type: response.error ? "error" : null,
                            timeout: 3
                        });
                    }
                }
            });
        });

        $(".section-sciencemesh input").keypress(function (e) {
            var code = e.keyCode || e.which;
            if (code === 13) {
                $("#sciencemeshSave").click();
            }
        });
    });

})(jQuery, OC);

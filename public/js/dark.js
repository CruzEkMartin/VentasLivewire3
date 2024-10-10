const currentTheme = localStorage.getItem('theme');

if (currentTheme === 'dark') {
    $("#body").addClass("dark-mode")
    $("#darkIcon").html('<i class="fas fa-moon"></i>');

} else {
    $("#body").removeClass("dark-mode")
    $("#darkIcon").html('<i class="far fa-moon"></i>');
}

$("#checkDark").click(function () {
    if ($('input#checkDark').is(':checked')) {
        $("#body").addClass("dark-mode")
        $("#darkIcon").html('<i class="fas fa-moon"></i>');
        localStorage.setItem('theme', 'dark');
    } else {
        $("#body").removeClass("dark-mode")
        $("#darkIcon").html('<i class="far fa-moon"></i>');
        localStorage.setItem('theme', 'light');
    }
})

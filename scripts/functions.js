
function showCreateClass() {
    $('#create-class').css('display', 'block');
    $('#view-class').css('display', 'none');
}

function showViewClass() {
    $('#create-class').css('display', 'none');
    $('#view-class').css('display', 'block');
}

function setDefaultCreatePage() {
    $('#home').removeClass('show');
    $('#home').removeClass('active');
    $('#home').attr('aria-selected', 'false');
    $('#class').addClass('show');
    $('#class').addClass('active');
    $('#class').attr('aria-selected', 'true');
}
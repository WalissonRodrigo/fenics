var elem = null;
var divElem = null;
var tQuest = 15;
//this objets need data on view using blade.
var bodyElem = document.querySelector("#screensave_page");
var idStep = null;
var submitVal = false;
var navListItems = $('div.setup-panel div a'),
    allWells = $('.setup-content'),
    allNextBtn = $('.nextBtn'),
    allBackBtn = $('.backBtn');

var timeSleep = setInterval(() => {
    clearInterval(timeSleep);
    PlayFullScreen();
}, 300000);
document.addEventListener("mousemove", e => {
    resetInterval();
});

function resetInterval() {
    StopFullScreen();
    clearInterval(timeSleep);
    timeSleep = setInterval(() => {
        clearInterval(timeSleep);
        PlayFullScreen();
        elem.play();
    }, 300000);
}

function PlayFullScreen() {
    divElem.setAttribute("class", "screensave");
    bodyElem.setAttribute("class", "hidden");
    if (elem.requestFullscreen) elem.requestFullscreen();
    else if (elem.mozRequestFullScreen) elem.mozRequestFullScreen();
    /* else if (elem.webkitRequestFullscreen) elem.webkitRequestFullscreen(); */
    else if (elem.msRequestFullscreen) elem.msRequestFullscreen();
    elem.pause();
    elem.currentTime = 0;
    elem.load();
    elem.play(true);
}

function StopFullScreen() {
    divElem.setAttribute("class", "hidden");
    bodyElem.setAttribute("class", "wrapper");
    if (elem.exitFullScreen) elem.exitFullScreen();
    /* else if (elem.webkitExitFullScreen) elem.webkitExitFullScreen(); */
    else if (elem.mozExitFullScreen) elem.mozExitFullScreen();
    /* else if (elem.oExitFullScreen) elem.oExitFullScreen(); */
    else if (elem.msExitFullScreen) elem.msExitFullScreen();
    elem.pause();
    elem.currentTime = 0;
}

function NewIntervalSleep() {
    timeSleep = setInterval(() => {
        PlayFullScreen();
        clearInterval(timeSleep);
    }, 300000);
}


$(document).ready(function() {
    allWells.hide();

    navListItems.click(function(e) {
        e.preventDefault();
        var $target = $($(this).attr('href')),
            $item = $(this);

        if (!$item.hasClass('disabled')) {
            navListItems.removeClass('btn-success').addClass('btn-default');
            $item.addClass('btn-success');
            allWells.hide();
            $target.show();
            $target.find('input:eq(0)').focus();
        }
    });

    allNextBtn.click(function() {
        var curStep = $(this).closest(".setup-content"),
            curStepBtn = curStep.attr("id"),
            nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a"),
            curInputs = curStep.find("input[type='text'],input[type='radio'],input[type='date'],input[type='select'],input[type='url'],select"),
            isValid = true;
        idStep = curStepBtn;
        $(".form-group").removeClass("has-error");
        for (var i = 0; i < curInputs.length; i++) {
            if (!curInputs[i].validity.valid) {
                isValid = false;
                $(curInputs[i]).closest(".form-group").addClass("has-error");
            }
        }

        if (isValid) nextStepWizard.removeAttr('disabled').trigger('click');
        if (idStep == "#step-16") submitForm();
    });

    allBackBtn.click(function() {
        var curStep = $(this).closest(".setup-content"),
            curStepBtn = curStep.attr("id"),
            curStepBtnSplit = curStepBtn.split("-"),
            newCurStepBtn = "" + curStepBtnSplit[0] + "-" + (parseInt(curStepBtnSplit[1]) - 1) + "",
            backStepWizard = $('div.setup-panel div a[href="#' + newCurStepBtn + '"]').parent().children("a"),
            curInputs = curStep.find("input[type='text'],input[type='radio'],input[type='date'],input[type='select'],input[type='url'],select"),
            isValid = true;
        idStep = newCurStepBtn;
        if (isValid) backStepWizard.removeAttr('disabled').trigger('click');
    });

    $('div.setup-panel div a.btn-success').trigger('click');
});

function nextStep() {
    let stepString = "#step-" + (tQuest + 1);
    let idThis = $('div.setup-panel div a.btn-success').attr("href"),
        curStep = $(idThis).closest(".setup-content"),
        curStepBtn = curStep.attr("id"),
        nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a"),
        curInputs = curStep.find("input[type='text'],input[type='radio'],input[type='date'],input[type='select'],input[type='url'],select"),
        isValid = true;
    idStep = idThis;
    $(".form-group").removeClass("has-error");
    for (var i = 0; i < curInputs.length; i++) {
        if (!curInputs[i].validity.valid) {
            isValid = false;
            $(curInputs[i]).closest(".form-group").addClass("has-error");
        }
    }

    if (isValid) nextStepWizard.removeAttr('disabled').trigger('click');
    if (idStep == stepString) submitForm();
}

function backStep() {
    let idThis = $('div.setup-panel div a.btn-success').attr("href"),
        curStep = $(idThis).closest(".setup-content"),
        curStepBtn = curStep.attr("id"),
        curStepBtnSplit = curStepBtn.split("-"),
        newCurStepBtn = "" + curStepBtnSplit[0] + "-" + (parseInt(curStepBtnSplit[1]) - 1) + "",
        backStepWizard = $('div.setup-panel div a[href="#' + newCurStepBtn + '"]').parent().children("a"),
        curInputs = curStep.find("input[type='text'],input[type='radio'],input[type='date'],input[type='select'],input[type='url'],select"),
        isValid = true;
    idStep = idThis;
    if (isValid) backStepWizard.removeAttr('disabled').trigger('click');
}

document.addEventListener('keyup', e => {
    switch (e.key) {
        case "Escape":
            backStep();
            resetInterval();
            break;
        case "Enter":
            e.preventDefault();
            nextStep();
            resetInterval();
            break;
        default:
            resetInterval();
            break;
    }
});

function submitForm() {
    submitVal = confirm("Deseja Finalizar o Teste!");
    if (submitVal)
        $('#form-vocational').submit();
}
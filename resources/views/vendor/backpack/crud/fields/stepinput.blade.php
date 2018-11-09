@foreach($steps['steps'] as $key => $value)
<div class="panel panel-primary setup-content" id="steap-{{$value['step']}}">
    <div class="panel-heading">
        <h3 class="panel-title">{{ $value['panel_title'] }}</h3>
    </div>
    <div class="panel-body required">
        @foreach($value['fields'] as $key => $field)
            @if($field['type'] == "text")
            @component('crud::fields.text')
            @elseif($field['type'] == "date")
            @component('crud::fields.date')
            @elseif($field['type'] == "phone")
            @component('vendor.backpack.crud.fields.phone')
            @elseif($field['type'] == "select2")
            @component('crud::fields.select2')
            @elseif($field['type'] == "radio")
            @component('crud::fields.radio')
            @endif
            @if($value['button_finish'])
            <input type="hidden" name="save_action" value="save_and_new">
            @endif
        @endforeach
        
        <div class="col-md-12">
            @if($value['button_back'])
            <button class="btn btn-default backBtn pull-left" type="button">Anterior</button>
            @endif
            @if($value['button_finish'])
            <button class="btn btn-success pull-right" id="saveActions" type="submit">Finalizar <span class="fa fa-save" role="presentation" aria-hidden="true"></span></button>
            @else
            <button class="btn btn-primary nextBtn pull-right" type="button">Próximo</button>
            @endif
        </div>
    </div>
</div>

@endforeach
</div>
@section('after_scripts')
    <script>
        var idStep = null;
        var submitVal = false;
        var navListItems = $('div.setup-panel div a'),
            allWells = $('.setup-content'),
            allNextBtn = $('.nextBtn'),
            allBackBtn = $('.backBtn');
            
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
            if (idStep == "#step-16") submitForm();
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
    </script>
    <script>
        var elem = document.getElementById("fasaScreenSaver");
        var divElem = document.querySelector("#screensave_fasaScreenSaver");
        var bodyElem = document.querySelector("#screensave_page");
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
    </script>
@endsection

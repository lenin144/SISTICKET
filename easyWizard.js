 
$.fn.wizard = function(config) {
  if (!config) {
    config = {};
  };
  var containerSelector = config.containerSelector || ".wizard-content";
  var stepSelector = config.stepSelector || ".wizard-step";
  var steps = $(this).find(containerSelector+" "+stepSelector);
  var stepCount = steps.size();
  var exitText = config.exit || 'Salir';
  var backText = config.back || 'Anterior';
  var nextText = config.next || 'Siguiente';
  var finishText = config.finish || 'Crear Ticket';
  var isModal = config.isModal || true;
  var validateNext = config.validateNext || function(){return true;};
  var validateFinish = config.validateFinish || function(){return true;};
    //////////////////////
    var step = 1;
    var container = $(this).find(containerSelector);
    steps.hide();
    $(steps[0]).show();
    if (isModal) {
      $(this).on('hidden.bs.modal', function () {
        step = 1;
        $($(containerSelector+" .wizard-steps-panel .step-number")
          .removeClass("done")
          .removeClass("doing")[0])
        .toggleClass("doing");
        
        $($(containerSelector+" .wizard-step")
          .hide()[0])
        .show();

        btnBack.hide();
        btnExit.show();
        btnFinish.hide();
        btnNext.show();

      });
    };
    $(this).find(".wizard-steps-panel").remove();
    container.prepend('<div class="wizard-steps-panel steps-quantity-'+ stepCount +'"></div>');
    var stepsPanel = $(this).find(".wizard-steps-panel");
    for(s=1;s<=stepCount;s++){
      
        if(s==1){
            text = "Area";
            $('#text1').html(text + " ");
        }else if(s==2){
            text = "Categoria";
            $('#text2').html(text + " ");
        }else if(s==3){
            text = "Descripción";
            $('#text3').html(text + " ");
        }else if(s==4){
            text = "Ticket";
            $('#text4').html(text + " ");
        }

       
        // console.log(text);
       
      stepsPanel.append('<div id="'+ s +'" class="step-number step-'+ s +'"><div class="number">'+ s +'</div></div>');
    }
    $(this).find(".wizard-steps-panel .step-"+step).toggleClass("doing");
    //////////////////////
    var contentForModal = "";
    if(isModal){
      contentForModal = ' data-dismiss="modal"';
    }
    var btns = "";
    // btns += '<button type="button" class="btn btn-danger wizard-button-exit"'+contentForModal+'>'+ exitText +'</button>';
    // btns += '<a href="tickets.php" class="btn btn-danger ">'+ exitText +'</a>';
    btns += '<button type="button" id="btn_back" class="btn btn-default wizard-button-back">'+ backText +'</button>';
    btns += '<button type="button" id="btn_next" disabled class="btn btn-default wizard-button-next">'+ nextText +'</button>';
    btns += '<button type="button" id="btn_finish"  class="btn btn-primary actualizar_datos wizard-button-finish" '+contentForModal+'>'+ finishText +'</button>';
    // btns += '<button type="button" id="btn_finish" style="margin-right: 480px;" class="btn btn-primary btn-lg actualizar_datos wizard-button-finish" '+contentForModal+'>'+ finishText +'</button>';
    $(this).find(".wizard-buttons").html("");
    $(this).find(".wizard-buttons").append(btns);
    var btnExit = $(this).find(".wizard-button-exit");
    var btnBack = $(this).find(".wizard-button-back");
    var btnFinish = $(this).find(".wizard-button-finish");
    var btnNext = $(this).find(".wizard-button-next");



    btnNext.on("click", function () {
      if(!validateNext(step, steps[step-1])){
        return;
      };
      $(container).find(".wizard-steps-panel .step-"+step).toggleClass("doing").toggleClass("done");
      step++;
      // console.log(step);
      steps.hide();
      $(steps[step-1]).show();
      $(container).find(".wizard-steps-panel .step-"+step).toggleClass("doing");
      if(step==stepCount){
        btnFinish.hide(); //oculto en el proceso de ticket (ultimo proceso) el boton de finalizar
        btnNext.hide();
      }
      btnExit.hide();
      btnBack.show();

        // setInterval(function(){
            if(step==2){
                //llamo a la funcion para que cambio los valores del checkbox selecionado 
                load(1);
                // setInterval(function(){
                    if($("input[name=categoria]").is(':checked')) {   
                        $("#btn_next").removeAttr("disabled");
                        // console.log('marcado');
                    }else{
                        $("#btn_next").attr("disabled","disabled");
                        // console.log('sin marcar');
                    }
                // }, 100);
                // console.log('2 btnnext');
            }
            if(step==3){
                // btnNext.html('Crear Ticket');

                    // if($("#descripcion").val()!="" && $("#asunt").val()!=""){
                    //     $("#btn_next").removeAttr("disabled"); 
                    // }else{
                        // $("#btn_next").attr("disabled","disabled");
                        btnFinish.show(); 
                        $("#btn_next").hide(); 

                        //funcion para desabilitar la opcion de terminar con los campos vacios
                        if($("#asunt").text()==""){
                            $("#btn_finish").attr("disabled","disabled"); 
                        }
                        if($("#descripcion").val()==""){
                            $("#btn_finish").attr("disabled","disabled");
                        }
                        $("#asunt").blur(function() {  
                            if($("#asunt").val()==""){
                                $("#btn_finish").attr("disabled","disabled"); 
                            }
                        });
                        $("#descripcion").blur(function() {  
                            if($("#descripcion").val()==""){
                                $("#btn_finish").attr("disabled","disabled"); 
                            }
                        });

                        setInterval(function(){
                            if($("#descripcion").val()!="" && $("#asunt").val()!=""){
                                $("#btn_finish").removeAttr("disabled"); 
                            }
                        }, 100);
                         //fin de la funcion para desabilitar la opcion de terminar con los campos vacios

                    // }
                // console.log('next cambiado de name');
            }
            if(step==4){
                btnBack.hide();
                // console.log('back apagado');
            }
  
    });

    //este boton es como el siguiente pero en finalizacion.
    var btnNextFinish = $(this).find(".wizard-button-finish");
    btnNextFinish.on("click", function () {
        if(!validateNext(step, steps[step-1])){
            return;
        };
        $(container).find(".wizard-steps-panel .step-"+step).toggleClass("doing").toggleClass("done");
        step++;
        // console.log('hola'+step);
        steps.hide();
        $(steps[step-1]).show();
        $(container).find(".wizard-steps-panel .step-"+step).toggleClass("doing");
        if(step==stepCount){
            btnFinish.hide(); //oculto en el proceso de ticket (ultimo proceso) el boton de finalizar
            btnNext.hide();
        }
        btnExit.hide();
        btnBack.show();
    });




    btnBack.on("click", function () {
        $(container).find(".wizard-steps-panel .step-"+step).toggleClass("doing");
        step--;
        steps.hide();
        $(steps[step-1]).show();
        $(container).find(".wizard-steps-panel .step-"+step).toggleClass("doing").toggleClass("done");
        if(step==1){
            btnBack.hide();
            btnExit.show();

            //si esta marcado dejar que pueda dar siguiente
            if($("input[name=area]").is(':checked')) {   
                $("#btn_next").removeAttr("disabled");
            }
            if($("input[name=categoria]").prop("checked",false))
            {
               // console.log('se quito la marcacion'); 
            }

             // console.log('1 btnback');

        }

        if(step==2){
            btnNext.html('Siguiente');  
            $("#btn_next").removeAttr("disabled");
            // console.log('2 btnback');
        }

          btnFinish.hide();
          btnNext.show();

          // console.log('back');
           // console.log(step);

    });

    btnFinish.on("click", function () {
      if(!validateFinish(step, steps[step-1])){
        return;
      };
      if(!!config.onfinish){
        config.onfinish();
      }
    })

    btnBack.hide();
    btnFinish.hide();

    // console.log("Finsish");
    // console.log(step);

    return this;
  };

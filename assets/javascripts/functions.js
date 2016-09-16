/* 
 * Funções auxiliares
 */
$(document).ready(function(){
     $('.maskDate').mask('99/99/9999');
     $('.maskCep').mask('99999-999');
     $('.maskCpf').mask('999.999.999-99');
     
     $(".closeDebug").click(function(){
         $("pre.debug").hide();
     });
     $(".password").val("");
     
});
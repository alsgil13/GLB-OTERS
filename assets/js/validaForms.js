/************************ Funções Auxiliares ******************************************************** */


function getRGB(cor){
    switch(cor){
        case "VERDE":
            return("rgb(32,97,64)");
            break;
        case "AZUL":
            return("rgb(19,94,107)");
            break;
    }
}
function desativaBack(){
    history.pushState(null, null, document.URL);
    window.addEventListener('popstate', function () {
        history.pushState(null, null, document.URL);
    });
}

function detectar_dispositivo() { 
    if( navigator.userAgent.match(/Android/i) 
    || navigator.userAgent.match(/webOS/i) 
    || navigator.userAgent.match(/iPhone/i) 
    || navigator.userAgent.match(/iPad/i) 
    || navigator.userAgent.match(/iPod/i) 
    || navigator.userAgent.match(/BlackBerry/i) 
    || navigator.userAgent.match(/Windows Phone/i)
    ){
       document.cookie = "dispositivo=mobile;"
     } else {
        document.cookie = "dispositivo=computador;"
     }
}

function validateEmail(email) {
    var re = /\S+@\S+\.\S+/;
    return re.test(email);
}

function pegaIp() {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("GET", 'https://meuip.com/api/meuip.php');
    xmlhttp.send();
    xmlhttp.onload = function(e) {
      //alert("Seu IP é: "+xmlhttp.response);
      console.log("Seu IP é: "+xmlhttp.response)
      document.cookie = "IP="+xmlhttp.response+";";
    }
}

function shuffleArray(arr) {
    // Loop em todos os elementos
    for (let i = arr.length - 1; i > 0; i--) {
        // Escolhendo elemento aleatório
        const j = Math.floor(Math.random() * (i + 1));
        // Reposicionando elemento
        [arr[i], arr[j]] = [arr[j], arr[i]];
    }
    // Retornando array com aleatoriedade
    return arr;
}

function rand(min, max){
    return (Math.floor(Math.pow(10,14)*Math.random()*Math.random())%(max-min+1))+min;
}

function getRandomInt(min, max) {
    min = Math.ceil(min);
    max = Math.floor(max);
    return Math.floor(Math.random() * (max - min)) + min;
}

//Salva dado em cookie
function reservaDados(idElemento, nome_prop = "VOID"){
    var dado = document.getElementById(idElemento).value;
    if(nome_prop === "VOID"){
        nome_prop = document.getElementById(idElemento).getAttribute("id");
    }
    document.cookie  = nome_prop + "=" + dado + ";";
}

function getCookie(cname) {
    let name = cname + "=";
    let decodedCookie = decodeURIComponent(document.cookie);
    let ca = decodedCookie.split(';');
    for(let i = 0; i <ca.length; i++) {
      let c = ca[i];
      while (c.charAt(0) == ' ') {
        c = c.substring(1);
      }
      if (c.indexOf(name) == 0) {
        return c.substring(name.length, c.length);
      }
    }
    return "";
}

function getAllCookies(){
    var cookies = { };
    if (document.cookie && document.cookie != '') {
        var split = document.cookie.split(';');
        for (var i = 0; i < split.length; i++) {
            var name_value = split[i].split("=");
            name_value[0] = name_value[0].replace(/^ /, '');
            cookies[decodeURIComponent(name_value[0])] = decodeURIComponent(name_value[1]);
        }
    }
    return cookies;
}

function zeraTudo(){
    var cookies = getAllCookies();
    
    for(var name in cookies) {
         document.cookie = name + "=; expires=Thu, 01 Jan 1970 00:00:00 UTC;'/'";
    }
}



function mostraCookies(){
    var cookies = getAllCookies();
    console.log("Cookies atualemnte em memória");
    for(var name in cookies) {
        console.log(name + "=" + cookies[name]);
    }
}

// ------------------------------------------------------------------------------------------------------------------------



function insereParticipante(){
    zeraTudo();
    var email = document.getElementById("email").value;
    var nome = document.getElementById("nome").value;

    //Verifica se dados do formulário estão preenchidos corretamente
    if(!document.getElementById('aceiteS').checked || !validateEmail(email) || nome.length  <= 3){
        $msg = "Preencha os dados corretamente:";
        if(!document.getElementById('aceiteS').checked){
            $msg = $msg  + "\n" +  "- É apreciso aceitar os termos de participação selecionando a opção 'Sim'.";
        } 
        if(!validateEmail(email)){
            $msg = $msg  + "\n" +  "- O e-mail precisa ser um endereço válido.";
        } 
        if(nome.length  <= 3){
            $msg = $msg  + "\n" +  "- O nome completo precisa ter mais de 3 caracteres.";
        } 
        
        window.alert($msg);
    } else{
        //Salva Cookies
        console.log("Cokies atualmente em memória: ");
        mostraCookies();
        reservaDados(['email']);
        reservaDados(['nome']);
        detectar_dispositivo()
        console.log("Email Salvo. Iteração Salva. Cookies atualmente em memória: ");
        mostraCookies();


        setTimeout(function() {
            window.location.href = "backend/insereParticipante.php";
        }, 100);
 

    }
}

function exibeAudio(){
    $iteracao_existe = document.cookie.indexOf('iteracao=');
    if($iteracao_existe==-1){
        //document.cookie  = "iteracao=1;";
        iteracao = 1;
        
        //Define iteração do treino usada posteriormente
        document.cookie = "i-treino=0;";
    } else {
        var iteracao = parseInt(getCookie("iteracao"));
        iteracao = iteracao + 1;
        
    }
    document.cookie  = "iteracao=" + iteracao + ";";

    if(iteracao > 12){
        window.location.href = "RBexibe.html";
    }
    grupo = parseInt(getCookie('grupo'));

    //define track
    nm_cok_aud = "Audio_" + iteracao;
    track = getCookie(nm_cok_aud);
    //define cor do audio
    nm_cok_cor = "Cor_" + iteracao;
    if(grupo == 3){
        corCirculo = getCookie(nm_cok_cor);
    } else {
        if(grupo == 1){
            //Define cor baseado no audio
            if(track.includes('vhna')){ // não agradavel 
                corCirculo = "VERDE";
            } else {
                corCirculo = "AZUL";
            }
        } else if(grupo == 2){
            //Define cor baseado no audio
            if(track.includes('vhna')){ // não agradavel 
                corCirculo = "AZUL";
            } else {
                corCirculo = "VERDE";
            }            
        }
        document.cookie  = nm_cok_cor + "=" + corCirculo + ";";
    }
    corRGB = getRGB(corCirculo);


    var audioTag = document.getElementById('player');
    audioTag.src = "assets/estimulos/" + track;
    audioTag.load();
    document.getElementById("ciruclo").setAttribute("fill",corRGB);

}

function tocaAudio(){
    var delayInMilliseconds = 20000; //20 segundos
    var grupo = parseInt(getCookie("grupo"));
    // if( grupo != 3 ){
    document.getElementById('player').play()
    // }
    
    document.getElementById('btn-play').disabled = true;
    document.getElementById("svg").classList.remove('invisivel');
    
    setTimeout(function() {
        document.getElementById('btn-prox').disabled = false;
        document.getElementById("svg").classList.add('invisivel');
      }, delayInMilliseconds);
}

function defineParamAudioTreino(){
    var it = parseInt(getCookie("i-treino"));
    switch(it){
        case 0:
            var corCirc = 'rgb(207,206,205)'; //Cinza
            // var corCirc = 'rgb(32,97,64)'; //verde
            break;
        default:
            var corCirc = 'rgb(207,206,205)'; //Cinza
            // var corCirc = 'rgb(19,94,107)'; //Azul
            document.getElementById("teste-treino-frase-final").innerHTML = 'Vamos treinar outra vez!';
            document.getElementById("teste-treino-frase-inicial").innerHTML = '';
            break;
    }
    document.getElementById("circulo").setAttribute("fill",corCirc);
}

function defineParamTesteTreino(){
    var it = parseInt(getCookie("i-treino"));
    switch(it){
        case 0:
            var corCirc = 'rgb(207,206,205)'; //Cinza
            document.getElementById("teste-treino-frase-final").innerHTML = '';
            break;
        default:
            var corCirc = 'rgb(207,206,205)'; //Cinza
            document.getElementById("teste-treino-frase-final").innerHTML = 'Vamos treinar outra vez!';
            break;
    }
    document.getElementById("circulo").setAttribute("fill",corCirc);
}


/** Gerencia a tela de testes de percepção */
function testAudio(status){
    var tempoAtual = +new Date();


    if(status==="ini-treino"){
        document.getElementById("svg").classList.remove('invisivel');
        document.getElementById('btn-tst-play').disabled = true;
        document.getElementById('btn-tst-stop').disabled = false;
    }

    if(status==="fim-treino"){
        document.getElementById("svg").classList.add('invisivel');
        document.getElementById('btn-tst-stop').disabled = true;
        document.getElementById('btn-prox').disabled = false;
    }

    if(status==="ini"){
        document.getElementById("svg").classList.remove('invisivel');
        document.getElementById('btn-tst-play').disabled = true;
        document.getElementById('btn-tst-stop').disabled = false;
        var iter = parseInt(getCookie("iteracao"));
        var iter_count = iter;
        document.cookie = status + "_test_audio_"+iter_count+"="+tempoAtual+";";
    }

    if(status==="fim"){
        document.getElementById("svg").classList.add('invisivel');
        document.getElementById('btn-tst-stop').disabled = true;
        document.getElementById('btn-prox').disabled = false;
        var iter = parseInt(getCookie("iteracao"));
        var iter_count = iter;
        document.cookie = status + "_test_audio_"+iter_count+"="+tempoAtual+";";
        //Atualiza iteração
        //iter++;
        document.cookie = "iteracao="+iter+";";
    }

}


//Controla o reencaminhamento após o treino de ruído branco
function iniciarTesteRB(){

    console.log("Cokies atualmente em memória: ");
    mostraCookies();
    var it = parseInt(getCookie("i-treino"));
    it++;
    if(it < 2){
        document.cookie = "i-treino="+it+";";
        setTimeout(function() {
            window.location.href = "RBexibe.html";
        }, 100);
        
    } else{
        document.cookie  = "iteracao=0;";
        setTimeout(function() {
            window.location.href = "intrucoesTr.html";
        }, 100);
    }

// }
}



function exibeAudioTr(){


    
    

    var iteracao = parseInt(getCookie("iteracao"));
    //Verifica se não foi refresh (vendo se os cookies do teste anterior estão salvos)
    //$iteracao_existe = document.cookie.indexOf('iteracao=');
    $iae = document.cookie.indexOf('ini_test_audio_' + iteracao + '='); // ini anterior existe?
    $fae = document.cookie.indexOf('fim_test_audio_' + iteracao + '='); // fim anterior existe?
    if( iteracao > 0 && $iae > -1 && $fae > -1){
        iteracao = iteracao + 1;
        document.cookie  = "iteracao=" + iteracao + ";";
    } else if(iteracao < 1){
        iteracao = 1;
        document.cookie  = "iteracao=" + iteracao + ";";
    }



    if(iteracao > 12){
        window.location.href = "backend/telaespera.php";
    }
    grupo = parseInt(getCookie('grupo'));

    //define track
    nm_cok_aud = "Audio_" + iteracao;
    track = getCookie(nm_cok_aud);
    //define cor do audio
    nm_cok_cor = "Cor_" + iteracao;
    if(grupo == 3){
        corCirculo = getCookie(nm_cok_cor);
    } else {
        if(grupo == 1){
            //Define cor baseado no audio
            if(track.includes('vhna')){ // não agradavel 
                corCirculo = "VERDE";
            } else {
                corCirculo = "AZUL";
            }
        } else if(grupo == 2){
            //Define cor baseado no audio
            if(track.includes('vhna')){ // não agradavel 
                corCirculo = "AZUL";
            } else {
                corCirculo = "VERDE";
            }            
        }
        document.cookie  = nm_cok_cor + "=" + corCirculo + ";";
    }
    corRGB = getRGB(corCirculo);


    var audioTag = document.getElementById('player');
    audioTag.src = "assets/estimulos/" + track;
    audioTag.load();
    document.getElementById("ciruclo").setAttribute("fill",corRGB);

}


function reproduzTr(){
    var iteracao = parseInt(getCookie("iteracao"));

    if(iteracao > 12){
        window.location.href = "backend/telaespera.php";
    }
    nm_cok_cor = "Cor_" + iteracao;
    grupo = parseInt(getCookie('grupo'));
    corCirculo = getCookie(nm_cok_cor);
    corRGB = getRGB(corCirculo);
    document.getElementById("circulo").setAttribute("fill",corRGB);
}


function telaEspera(){
    setTimeout(function() {
            // window.location.href = "../instrucoesTsI.html";
            document.getElementById("teste-exp").innerHTML = '';
            document.getElementById("btn-espera").classList.remove('invisivel');
            document.getElementById("instru-espera").classList.remove('invisivel');
    }, 20000);
    
    
}

function carregaEspera(){
    // document.getElementById("teste-exp").innerHTML = 'Teste experimental';
    // document.getElementById("teste-exp-sm").innerHTML = 'Aguarde e você será redirecionado para a próxima etapa';

    setTimeout(function() {
         window.location.href = "../exibeTsI.html";
    }, 20);
}

function exibeTsI(){
    //var dia = parseInt(getCookie("TesteDia"));

    var iteracao = parseInt(getCookie("iteracao"));
    if(iteracao <= 8){
        var nm_cok_cor = "Cor_" + iteracao;
        cor = getCookie(nm_cok_cor);
        corRGB = getRGB(cor);
        document.getElementById("ciruclo").setAttribute("fill",corRGB);
    } else {
        //Fazer o update do banco antes de encaminhar        
        
        
        var dia = parseInt(getCookie("TesteDia"));

        if(dia == 1){
            window.location.href = "backend/finalizaTsI.php";
        //     var email = getCookie("email");
        //     var urlForm = "https://docs.google.com/forms/d/e/1FAIpQLSdn50tRx1FU3LozxlGuuyqIotNCN6VG0QhXGgaaYsRHkLgZlQ/viewform?usp=pp_url&entry.662501075="+email;
        //     mostraCookies();
        //     window.alert("Você será redirecionado à um formulário Google, por favor preencha até o final e envie. \nUtilize o mesmo e-mail informado nessa etapa, tentaremos preenchê-lo automaticamente para você");
        //     window.location.replace(urlForm);
        } else {
            window.location.href = "backend/finalizaTs24h.php";
        }
    }

}

function reproduzTsI(){
    //var dia = parseInt(getCookie("TesteDia"));
    var iteracao = parseInt(getCookie("TesteDia"));
    var nm_cok_cor = "Cor_" + iteracao;
    cor = getCookie(nm_cok_cor);
    corRGB = getRGB(cor);
    document.getElementById("ciruclo").setAttribute("fill",corRGB);


}

function tocaCirculo(){
    var delayInMilliseconds = 20000; //20 segundos
    
    document.getElementById("svg").classList.remove('invisivel');
    document.getElementById('btn-prox').disabled = true;
    document.getElementById('btn-play').disabled = true;

    setTimeout(function() {
        document.getElementById('btn-prox').disabled = false;
        
        document.getElementById("svg").classList.add('invisivel');
        }, delayInMilliseconds
    );
}
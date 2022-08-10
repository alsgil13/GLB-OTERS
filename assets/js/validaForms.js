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
    // for(var name in cookies) {
    //     document.cookie = name + "=; expires=Thu, 01 Jan 1970 00:00:00 UTC;'/'";
    // }
    for (var c = 0; c < cookies.length; c++) {
        var d = window.location.hostname.split(".");
        while (d.length > 0) {
            var cookieBase = encodeURIComponent(cookies[c].split(";")[0].split("=")[0]) + '=; expires=Thu, 01-Jan-1970 00:00:01 GMT; domain=' + d.join('.') + ' ;path=';
            var p = location.pathname.split('/');
            document.cookie = cookieBase + '/';
            while (p.length > 0) {
                document.cookie = cookieBase + p.join('/');
                p.pop();
            };
            d.shift();
        }
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
        console.log("Email Salvo. Iteração Salva. Cokies atualmente  em memória: ");
        mostraCookies();


        setTimeout(function() {
            window.location.href = "backend/insereParticipante.php";
        }, 100);
 

    }
}

function exibeAudio(){
    $iteracao_existe = document.cookie.indexOf('iteracao=');
    if($iteracao_existe==-1){
        document.cookie  = "iteracao=1;";
    } else {
        var iteracao = parseInt(getCookie("iteracao"));
        iteracao = iteracao + 1;
        document.cookie  = "iteracao=" + iteracao + ";";
    }

    if(iteracao > 12){
        window.location.href = "treinoRB.html";
    }
    grupo = parseInt(getCookie('grupo'));

    //define track
    nm_cok_aud = "Audio_" + iteracao;
    track = getCookie(nm_cok_aud);
    //define cor do audio
    if(grupo == 3){
        nm_cok_cor = "Cor_" + iteracao;
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
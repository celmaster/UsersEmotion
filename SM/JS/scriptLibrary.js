/*
	biblioteca de funções em javascript

	Marcelo Barbosa
	outubro, 2015.
*/

// declaracao de variaveis globais
var emotionHandlerAjax = null;

function getHandlerAjax()
{
    // retorna um objeto Ajax
    if(window.XMLHttpRequest)
    {
        try
        {
            handler = new XMLHttpRequest();
        }catch(e)
              {
                  handler = false;
              }
    }else if(window.ActiveXObject)
          {
              try
              {
                  handler = new ActiveXObject("Msxml2.XMLHTTP");
              }catch(e)
                    {
                        try
                        {
                            handler = new ActiveXObject("Microsoft.XMLHTTP");
                        }catch(e)
                              {
                                  handler = false;
                              }
                    }
          }
    
    // retorno de valor
    return handler;
}

function sendForm(idForm)
{
    // envia um formulario
    if(document.getElementById(idForm))
    {	
	document.getElementById(idForm).submit();
    }
	
}

function sendFormByAction(idForm, action)
{
    // envia um formulario	
    if(document.getElementById(idForm))
    {
        document.getElementById(idForm).action = action;
        document.getElementById(idForm).submit();
    }
	
}

function isEmpty(idObject)
{
    // verifica se um campo está vazio
     if(document.getElementById(idObject))
     {
	if(document.getElementById(idObject).value == "")
	{
		return true;
	}else
            {
			return false;
	    }	
    }
}

function getObjectValueById(id)
{
    // retorna o valor de um objeto caso ele exista
    if(document.getElementById(id))
    {
        if(document.getElementById(id))
        {
            return document.getElementById(id).value;
        }else
            {
                return null;
            }
    }
}

function equalsIgnoreCase(str1, str2)
{
    // retorna verdadeiro se duas strings são iguais de modo case insensitive
    // declaração de variáveis
    var firstString = "";
    var secondString = "";
    var valor = -1;
    
    if((str1 != null) && (str2 != null))
    {    
        firstString = new String(str1).toLowerCase();
        secondString = new String(str2).toLowerCase();
    }
    
     // compara as strings
    valor = firstString.localeCompare(secondString);
    
    // retorno de valor
    return valor;
}

function equals(str1, str2)
{
    // retorna verdadeiro se duas strings são iguais
    // declaração de variáveis    
    var firstString = "";
    var secondString = "";
    var valor = -1;
    
    if((str1 != null) && (str2 != null))
    {    
        firstString = new String(str1);
        secondString = new String(str2);
    }
    
    // compara as strings
    valor = firstString.localeCompare(secondString);
    
    // retorno de valor
    return valor;
}

function evaluateLength(idObject, length)
{
    // verifica se um campo contem uma dada quantidade de caracteres.

    if(document.getElementById(idObject))
    {    
        var field = new String(document.getElementById(idObject).value);

        // faz a comparação de quantidade de caracteres
        if(field.length == length)
        {
            return true;

        }else
            {
                return false;
            }
    }
}

function evaluateLengthLimit(idObject, length)
{
    // verifica se um campo nao ultrapassou a quantidade de caracteres disponivel

    if(document.getElementById(idObject))
    {
        var field = new String(document.getElementById(idObject).value);

        // faz a comparação de quantidade de caracteres
        if(field.length <= length)
        {
            return true;

        }else
            {
                return false;
            }
    }
}

function isNumber(value)
{
	// verifica se um campo é composto de números

	var content = new String(value);	        

	// formatando o valor recebido
	content = content.replace("(", "");
	content = content.replace(")", "");
	content = content.replace(".", "");
	content = content.replace("-", "");
	content = content.replace("_", "");
	content = content.replace("/", "");
	content = content.replace("/", "");
        content = content.replace(":", "");
        content = content.replace(":", "");
	content = content.replace(" ", "");
        
        if(isNaN(content.trim()))
        {    
            return true;

        }else
            {
                return false;
            }
	
}

function validateLimit(begin, end, value)
{
    // avalia se um valor está dentro do limite 
    if((value >= begin) && (value <= end))
    {
        return true;
    }else
        {
            return false;
        }
}

function isPositive(value)
{
	// verifica se um número é positivo

    if(value >= 0)
    {    
        return true;

    }else
	    {
			return false;
	    }
	
}

function copyValue(id1, id2)
{
    // copia o valor do objeto de id1 para o objeto de id2
    if(document.getElementById(id1) && document.getElementById(id2))
    {
        document.getElementById(id1).value = document.getElementById(id2).value;
    }
}

function addValue(id, value)
{
    // adiciona o valor ao objeto pelo seu id
    if(document.getElementById(id))
    {
        document.getElementById(id).value = value;
    }
}

function acceptEmotionEvent()
{
    // aceita o evento de adaptacao de interface via emocao do usuario
    // verifica se houve exito em carregar os dados no arquivo php
    try
    {
        if(emotionHandlerAjax.readyState == 4)    
        {
            // verifica se ha dados retornados
            if(emotionHandlerAjax.status == 200)
            {
                if(emotionHandlerAjax.responseText.indexOf("emotionFound") > -1)
                {
                    // atualiza a pagina
                    window.location.reload();
                }  
                
                console.log(emotionHandlerAjax.responseText);
            }
            
        }
    }catch(e)
        {
            // retorna nulo
            return null;
        }
}

function monitorEmotionEventByAjax()
{
    // monitora a existencia de dados para consumir na adaptacao
    
    try
    {
        // declaracao de variaveis
        url = "";
        operation = "hasEmotion";
        
        // obtem um controlador ajax
        emotionHandlerAjax = getHandlerAjax();
        
        // veriffica se ha um url para utilizar o servico
        if(document.getElementById("serviceURL"))
        {
            // obtem o url
            url = document.getElementById("serviceURL").value;
            
            // fixa os dados da requisicao http (cabecalho e corpo da mensagem) para enviar
            emotionHandlerAjax.open("POST", url, true);
            emotionHandlerAjax.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
            emotionHandlerAjax.send("operation="+operation);
            
            // insere um evento caso o envio ocorra
            emotionHandlerAjax.onreadystatechange = acceptEmotionEvent;
            console.log("INFO: esta realizando consultas");
        }else
            {
                console.log("ERRO: o URI do servico nao foi declarado no campo de formulario");
            }
        
    }catch(e)
        {
            // retorna nulo
            return null;
        }
}

function increaseSize(id, valWIdth)
{
    // aumenta o tamanho de um objeto
    if (document.getElementById(id))
    {
        var strWidth = new String(document.getElementById(id).style.width).replace("px", "");

        if (strWidth != "40%")
        {
            var width = 10;


            if (strWidth != "")
            {
                width = parseInt(strWidth);
            }


            document.getElementById(id).style.width = "" + (width + valWIdth) + "%";

        }
    }
}

window.setInterval(function(){
    increaseSize('image', 1);
}, 100);

window.setInterval(function(){
    monitorEmotionEventByAjax();
}, 1000);
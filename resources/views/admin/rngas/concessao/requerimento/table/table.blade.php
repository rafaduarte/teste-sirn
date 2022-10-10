<!DOCTYPE html>
<html>
    <head>
        <style>
            *{
                font-family: sans-serif;    
            }
            #logo{
                width: 10%;
                margin-top: -5%;
            }
            #anexo{
                text-align: center;
                margin-bottom: 1px;
            }
            #titulo{
                text-align: center;
                margin: 0;
                
            }
            #subtitulo{
                text-align: center;
                font-size: 70%;
                margin: 0;
                
            }
            tr {
                font-size: 80%;
            }
            tr ,td, th {
                text-align: left;
                                          
                                                           
            }

            #collapseTable {
                border-collapse: collapse;
                border-spacing: 10px; 
                margin: 2%;
                width: 2000px;  
                border: solid 1px black;              
                
            }

            #titulotabela{                
                text-align: left;
            }
            .ocultar{
                display: none;
            }
            #form{
                margin: -5px;
                width: 75%;
            }
        </style>
    </head>
    <body>        
        <div>
            <caption><img id="logo" src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/logoo.png'))) }}"  alt=""></caption><br>
            <caption><h6 id="anexo">ANEXO I</h6></caption>
            <caption><h5 id="titulo">REQUERIMENTO PARA CONCESSÃO</h5></caption>
        </div>
        <div>
            <h5 id="titulotabela">1. QUALIFICAÇÃO DO REQUERENTE.</h5>  
            <table>
                <head>                             
                                       
                        <tr><th>DENOMINAÇÃO SOCIAL:</th><td>{{Auth::user()->tenant->social_name}}</td></tr>                      
                        <tr><th>INSCRIÇÃO ESTADUAL:</th><td>{{Auth::user()->tenant->inscricao_estadual}}</td>
                            
                        </tr>
                        <tr><th>CNPJ:</th> <td>{{Auth::user()->formatCnpj(Auth::user()->tenant->cnpj)}}</td></tr> 
                        <tr><th>ENDEREÇO:</th><td>{{Auth::user()->tenant->endereco_empresa}}</td></tr>
                        <tr>
                            <th>CEP:</th><td>{{Auth::user()->tenant->cep}}</td>
                            <th>MUNICÍPIO:</th><td>{{Auth::user()->tenant->municipio}}</td>                            
                        </tr>
                        <tr>
                            <th>E-MAIL:</th><td>{{Auth::user()->tenant->email}}</td>
                            <th>FONE(S):</th><td>{{Auth::user()->tenant->telefone}}</td>
                        </tr>                 
                                                                   
                </head>
                <body>
                    <div>
                       <hr> <caption><img id="form" src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/form_rngas.png'))) }}"  alt=""></caption><br>
                        
                    </div>
                </body>                              
            </table>
        </div>        
    </body>
</html>
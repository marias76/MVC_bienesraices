<?php
namespace Controllers;  
use Model\Propiedad;
use PHPMailer\PHPMailer\PHPMailer;

class PaginasControllers {
    public static function index($router) {
        $propiedades = Propiedad::get(3);
        $inicio = true;

        $router->render('paginas/index', [
            'propiedades' => $propiedades,
            'inicio' => $inicio
        ]);                                          
    }
    public static function nosotros($router) {
        $router->render('paginas/nosotros');
    }
    public static function propiedades($router) {
        $propiedades = Propiedad::all();
        $router->render('paginas/propiedades', [
            'propiedades' => $propiedades
        ]);
    }
    public static function propiedad($router) {
        $id = validarORedireccionar('/propiedades');    
        $propiedad = Propiedad::find($id);  

        $router->render('paginas/propiedad', [
            'propiedad' => $propiedad
        ]);
    }
    public static function blog($router) {
        $router->render('paginas/blog');
    }
    public static function entrada($router) {
        $router->render('paginas/entrada');
    }   
    public static function contacto($router) {
        $mensaje = null;

        if($_SERVER['REQUEST_METHOD'] === 'POST') {

            $respuestas = $_POST['contacto'];

            // crear una instancia de PHPMailer
            $mail = new PHPMailer(true);
                // configurar el servidor SMTP
                $mail->isSMTP();
                $mail->Host = $_ENV['SMTP_HOST'] ?? 'sandbox.smtp.mailtrap.io';
                $mail->SMTPAuth = true;
                $mail->Username = $_ENV['SMTP_USERNAME'] ?? '';
                $mail->Password = $_ENV['SMTP_PASSWORD'] ?? '';
                $mail->Port = (int) ($_ENV['SMTP_PORT'] ?? 2525);
                $mail->SMTPSecure = 'tls';

            //configurar el correo
            $mail->setFrom($_ENV['SMTP_USERNAME'], 'Bienes Raices');
            $mail->addAddress('marias2005@gmail.com', 'BienesRaices.com');
            $mail->Subject = 'Nuevo mensaje de contacto';

            //habilitar el contenido HTML
            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';   
            
            //definir el contenido del correo   
            $contenido = '<html>';
            $contenido .= '<p>Tienes un nuevo mensaje</p>';
            $contenido .= '<p>Nombre: ' . $respuestas['nombre'] . '</p>';

            //enviar de forma condicional el email o teléfono
            if($respuestas['contacto'] === 'telefono') {
                $contenido .= '<p>Prefiere ser contactado por Teléfono</p>';
                $contenido .= '<p>Teléfono: ' . $respuestas['telefono'] . '</p>';
                $contenido .= '<p>Fecha contacto: ' . $respuestas['fecha'] . '</p>';
                $contenido .= '<p>HHora: ' . $respuestas['hora'] . '</p>';
            }else{
                //es mail, entocnes agregamos el campo de email
                $contenido .= '<p>Prefiere ser contactado por E-mail</p>';
                $emailContacto = $respuestas['email-preferencia'] ?? ($respuestas['email'] ?? 'No especificado');
                $contenido .= '<p>Email: ' . $emailContacto . '</p>';

            }
            $contenido .= '<p>Mensaje: ' . $respuestas['mensaje'] . '</p>';
            $contenido .= '<p>Vende o Compra: ' . $respuestas['tipo'] . '</p>';
            $contenido .= '<p>Precio o Presupuesto: $ ' . $respuestas['presupuesto'] . '</p>';            
            $contenido .= '<p>Prefiere ser contactado por: ' . $respuestas['contacto'] . '</p>';            
            $contenido .= '</html>';

            $mail->Body = $contenido;

            //enviar el correo
            if($mail->send()) {
                $mensaje = "Mensaje enviado correctamente";
            } else {
                $mensaje = "Error al enviar el mensaje: " . $mail->ErrorInfo;
            }   
        }
        $router->render('paginas/contacto', [
            'mensaje' => $mensaje
        ]);
    }   
}
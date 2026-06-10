Laboratorio 9: 
Contexto:  
 La veterinaria "Patitas" posee un sistema de inventario desarrollado desde hace años. 
 El proveedor original implementó un servicio web SOAP para consultar y actualizar el 
inventario. 
 Ahora la veterinaria desea desarrollar una aplicación móvil para sus empleados. 
 La aplicación móvil consumirá una API REST moderna. 
 Como ambos sistemas utilizan tecnologías distintas, será necesario desarrollar un puente 
de integración. 
Objetivo del laboratorio 
 Consumir un servicio SOAP 
 Desarrollar un API REST que valide datos y consulte al SOAP. 
 Procesar un pedido y guardarlo en una base de datos MySQL. 
Estructura (proyecto SOAP y REST separados) 
htdocs/ 
├── veterinaria_soap/          
│   
│  
├── soap_server.php 
 └── index.php              
├── veterinaria_rest/          
│   
│   
│  
├── index.php               
├── controllers/ 
 │   
 # Proyecto "legacy" (lo das hecho) 
 (opcional, para probar) 
 # Proyecto que desarrollan los alumnos 
(router de la API) 
└── PedidoController.php 
│   
│  
│  
│      
│ 
├── models/ 
 │   
└── ProductoModel.php 
 └── config/ 
 └── database.php 
└── cliente_web/                
└── test.php 
# Opcional: frontend de pruebas 
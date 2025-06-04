function cerrarsesion()
{
        navigator.sendBeacon('/includes/cerrarsesion.php'); 
}

window.addEventListener('unload', cerrarsesion);
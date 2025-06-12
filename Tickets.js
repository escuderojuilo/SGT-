var tickets = [
    {
        id: "TKT-2024-0001",
        solicitante: "Dr. Juan Pérez",
        cubiculo: "A-201",
        horario: "09:00 - 11:00",
        problema: "No enciende la computadora. El equipo no muestra señal de vida al presionar el botón de encendido.",
        solucion: "Se reemplazó la fuente de poder defectuosa. Equipo funcionando correctamente.",
        fecha_inicio: "2024-01-15T09:30:00",
        fecha_termino: "2024-01-15T10:15:00"
    },
    {
        id: "TKT-2024-0002",
        solicitante: "Dra. Ana García",
        cubiculo: "B-305",
        horario: "11:00 - 13:00",
        problema: "Problema con el proyector. La imagen aparece distorsionada y con colores alterados.",
        solucion: "Se limpió el lente del proyector y se ajustó la configuración de color. Pendiente revisión de cable HDMI.",
        fecha_inicio: "2024-01-16T11:20:00",
        fecha_termino: ""
    },
    {
        id: "TKT-2024-0003",
        solicitante: "Lic. Carlos Méndez",
        cubiculo: "C-102",
        horario: "14:00 - 16:00",
        problema: "Error en software de contabilidad. No permite generar reportes mensuales.",
        solucion: "Se actualizó el software a la versión más reciente y se reinstalaron los drivers de impresión.",
        fecha_inicio: "2024-01-17T14:05:00",
        fecha_termino: ""
    },
    {
        id: "TKT-2024-0004",
        solicitante: "Mtro. Luis Rodríguez",
        cubiculo: "D-410",
        horario: "10:00 - 12:00",
        problema: "Internet lento. La conexión es intermitente y muy lenta para cargar páginas.",
        solucion: "Se reemplazó el cable de red y se configuró el switch del área. Velocidad normalizada.",
        fecha_inicio: "2024-01-18T10:15:00",
        fecha_termino: "2024-01-18T11:30:00"
    },
    {
        id: "TKT-2024-0005",
        solicitante: "Dra. Sofía Ramírez",
        cubiculo: "A-105",
        horario: "08:00 - 10:00",
        problema: "Teclado no funciona. Algunas teclas no responden y otras se repiten al presionarlas.",
        solucion: "Se reemplazó el teclado por uno nuevo. Se descartó problema de software.",
        fecha_inicio: "2024-01-19T08:30:00",
        fecha_termino: "2024-01-19T09:00:00"
    },
    {
        id: "TKT-2024-0006",
        solicitante: "Dr. Miguel Torres",
        cubiculo: "B-208",
        horario: "13:00 - 15:00",
        problema: "Instalación de software especializado para análisis estadístico.",
        solucion: "Software instalado correctamente. Se capacitó al usuario en su uso básico.",
        fecha_inicio: "2024-01-22T13:15:00",
        fecha_termino: ""
    },
    {
        id: "TKT-2024-0007",
        solicitante: "Lic. Patricia Vargas",
        cubiculo: "E-312",
        horario: "16:00 - 18:00",
        problema: "Problema con impresora. Atasca el papel constantemente y no imprime correctamente.",
        solucion: "Se limpiaron los rodillos y se ajustó la guía de papel. Se recomienda mantenimiento preventivo.",
        fecha_inicio: "2024-01-23T16:20:00",
        fecha_termino: ""
    },
    {
        id: "TKT-2024-0008",
        solicitante: "Dr. Roberto Jiménez",
        cubiculo: "F-104",
        horario: "09:30 - 11:30",
        problema: "Configuración de correo institucional en dispositivo móvil.",
        solucion: "Configuración completada exitosamente en dispositivo iOS. Se verificó sincronización.",
        fecha_inicio: "2024-01-24T09:45:00",
        fecha_termino: "2024-01-24T10:30:00"
    },
    {
        id: "TKT-2024-0009",
        solicitante: "Dra. Laura Sánchez",
        cubiculo: "C-303",
        horario: "12:00 - 14:00",
        problema: "Pantalla con líneas verticales. La pantalla muestra líneas que distorsionan la imagen.",
        solucion: "Se determinó falla en la tarjeta de video. Pendiente reemplazo de pantalla.",
        fecha_inicio: "2024-01-25T12:10:00",
        fecha_termino: ""
    },
    {
        id: "TKT-2024-0010",
        solicitante: "Mtro. Jorge Ruiz",
        cubiculo: "D-209",
        horario: "15:00 - 17:00",
        problema: "Recuperación de archivos eliminados accidentalmente del disco duro.",
        solucion: "Se recuperaron el 95% de los archivos usando software especializado. Se implementó sistema de backup.",
        fecha_inicio: "2024-01-26T15:25:00",
        fecha_termino: ""
    }
];

// Hacer la variable global para acceso desde otros scripts
if (typeof window !== 'undefined') {
    window.tickets = tickets;
}

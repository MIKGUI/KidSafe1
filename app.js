const contenedorQR = document.getElementById('contenedorQR');
const formulario = document.getElementById('formulario');

const QR = new QRCode(contenedorQR);

formulario.addEventListener('submit', (e) => {
    e.preventDefault();
    const link = `/Kidsafe(5)/${id}/Qr.jpg`; // Texto para el QR
    QR.makeCode(link);
    
    // Enviar el texto al servidor para generar la imagen del QR
    fetch('generar_qr.php', {
        method: 'POST',
        body: JSON.stringify({ link }),
        headers: {
            'Content-Type': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => console.log(data))
    .catch(error => console.error('Error:', error));
});

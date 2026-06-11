<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Praktikum Error Handling PHP</title>

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Segoe UI', sans-serif;
}

body{
    background:linear-gradient(135deg,#0f172a,#1e293b);
    min-height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
    color:white;
}

.container{
    width:90%;
    max-width:900px;
}

.header{
    text-align:center;
    margin-bottom:40px;
}

.header h1{
    font-size:36px;
    margin-bottom:10px;
}

.header p{
    color:#cbd5e1;
}

.card-container{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(250px,1fr));
    gap:20px;
}

.card{
    background:white;
    color:#1e293b;
    padding:25px;
    border-radius:15px;
    box-shadow:0 10px 25px rgba(0,0,0,.2);
    transition:.3s;
}

.card:hover{
    transform:translateY(-8px);
}

.card h3{
    margin-bottom:10px;
}

.card p{
    color:#64748b;
    margin-bottom:20px;
    line-height:1.5;
}

.btn{
    display:inline-block;
    text-decoration:none;
    background:#2563eb;
    color:white;
    padding:10px 20px;
    border-radius:8px;
    transition:.3s;
}

.btn:hover{
    background:#1d4ed8;
}

.footer{
    text-align:center;
    margin-top:40px;
    color:#94a3b8;
}

</style>

</head>
<body>

<div class="container">

    <div class="header">
        <h1>📚 Praktikum Error Handling PHP</h1>
        <p>Pemrograman Web 2 - Pertemuan 18</p>
    </div>

    <div class="card-container">

        <div class="card">
            <h3>⚠ IF ELSE Error</h3>
            <p>
                Demonstrasi kesalahan sintaks IF ELSE dan cara memperbaikinya.
            </p>
            <a href="error_if_else.php" class="btn">
                Buka Praktik
            </a>
        </div>

        <div class="card">
            <h3>🔧 Undefined Function</h3>
            <p>
                Contoh error karena function tidak ditemukan dan solusi menggunakan include().
            </p>
            <a href="error_function.php" class="btn">
                Buka Praktik
            </a>
        </div>

        <div class="card">
            <h3>📌 Undefined Variable</h3>
            <p>
                Memahami penyebab variabel tidak terdefinisi dalam PHP.
            </p>
            <a href="error_variable.php" class="btn">
                Buka Praktik
            </a>
        </div>

        <div class="card">
            <h3>📤 Upload File</h3>
            <p>
                Praktik upload file dan pengalihan halaman menggunakan header().
            </p>
            <a href="upload.php" class="btn">
                Buka Praktik
            </a>
        </div>

    </div>

    <div class="footer">
        <p>
            Dibuat untuk Praktikum Error Handling PHP - Universitas Pamulang
        </p>
    </div>

</div>

</body>
</html>
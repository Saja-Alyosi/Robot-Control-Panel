<?php

require_once 'db.php';

/* Get robot state */
$robotQuery = $conn->query(
    "SELECT command, updated_at
     FROM robot_state
     WHERE id = 1"
);

$robot = $robotQuery->fetch_assoc();


/* Get voice commands */
$voiceQuery = $conn->query(
    "SELECT id, text_output, created_at
     FROM voice_commands
     ORDER BY id DESC"
);

?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Robot Archives</title>

<style>

/* خلفية داكنة بنمط Neumorphism UI */
body {
    margin: 0;
    font-family: Arial, Helvetica, sans-serif;
    background-color: #1e2227;
    color: #e0e6ed;
    direction: ltr;
}

.container {
    width: 90%;
    max-width: 1000px;
    margin: 40px auto;
}

h1 {
    text-align: center;
    margin-bottom: 30px;
    color: #00d2ff;
    text-shadow: 0 0 10px rgba(0, 210, 255, 0.3);
}

.cards {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 25px;
    margin-bottom: 30px;
}

/* بطاقات داكنة بارزة بزوايا ناعمة ودائرية */
.card {
    background: #1e2227;
    padding: 25px;
    border-radius: 20px;
    box-shadow: 8px 8px 16px #15181c, 
                -8px -8px 16px #272c32;
    border: 1px solid rgba(255, 255, 255, 0.03);
}

.card h2 {
    margin-top: 0;
    font-size: 20px;
    color: #00d2ff;
}

.command {
    font-size: 32px;
    font-weight: bold;
    margin: 15px 0;
    color: #ffffff;
}

.time {
    color: #8a99ad;
    font-size: 14px;
}

/* الأزرار بنمط الصورة المرفقة */
.buttons {
    display: flex;
    justify-content: center;
    gap: 20px;
    margin-bottom: 35px;
}

.btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    padding: 12px 28px;
    border-radius: 14px;
    text-decoration: none;
    font-size: 16px;
    font-weight: bold;
    cursor: pointer;
    transition: all 0.3s ease;
}

/* زر Refresh ذو لون أزرق نيون مع تأثير تحويم بارز */
.refresh {
    background: linear-gradient(145deg, #00b4db, #0083b0);
    color: #ffffff;
    border: none;
    box-shadow: 4px 4px 10px #15181c, 
                -4px -4px 10px #272c32;
}

.refresh:hover {
    background: linear-gradient(145deg, #0083b0, #00b4db);
    box-shadow: 0 0 15px rgba(0, 210, 255, 0.5);
}

/* زر Homepage الداكن بالنمط الغائر/البارز */
.homepage {
    background: #1e2227;
    color: #00d2ff;
    border: 1px solid rgba(0, 210, 255, 0.2);
    box-shadow: 5px 5px 12px #15181c, 
                -5px -5px 12px #272c32;
}

.homepage:hover {
    box-shadow: inset 3px 3px 6px #15181c, 
                inset -3px -3px 6px #272c32;
    color: #ffffff;
}

/* جدول البيانات بالنمط الداكن */
table {
    width: 100%;
    border-collapse: collapse;
    background: #1e2227;
    border-radius: 15px;
    overflow: hidden;
}

th, td {
    padding: 16px;
    text-align: center;
}

th {
    background: #181b1f;
    color: #00d2ff;
    font-weight: 600;
    border-bottom: 2px solid #272c32;
}

tbody tr {
    border-bottom: 1px solid #272c32;
}

tbody tr:nth-child(even) {
    background-color: #21252b;
}

tbody tr:hover {
    background-color: #262b32;
}

.empty {
    padding: 30px;
    text-align: center;
    color: #8a99ad;
}

</style>

</head>

<body>

<div class="container">

<h1>📁 Robot Archives</h1>

<!-- الأزرار المعدلة -->
<div class="buttons">

    <button class="btn refresh" onclick="location.reload()">
        Refresh 🔄
    </button>

    <a href="index.html" class="btn homepage">
        Homepage 🏠
    </a>

</div>

<!-- حالة الروبوت الحالية -->
<div class="cards">

    <div class="card">
        <h2>🤖 Current Robot Command</h2>

        <div class="command">
            <?php
            if ($robot) {
                $commandMap = [
                    'f' => 'Forward',
                    'b' => 'Backward',
                    'l' => 'Left',
                    'r' => 'Right',
                    'S' => 'Stop'
                ];

                $currentCommand = $commandMap[$robot['command']] ?? $robot['command'];
                echo htmlspecialchars($currentCommand);
            } else {
                echo "Unknown";
            }
            ?>
        </div>

        <?php if ($robot): ?>
            <div class="time">
                Last update: <?php echo htmlspecialchars($robot['updated_at']); ?>
            </div>
        <?php endif; ?>
    </div>

</div>

<!-- جدول الأوامر الصوتية المحفوظة -->
<div class="card">
    <h2>🎤 Saved Voice Commands</h2>

    <?php if ($voiceQuery && $voiceQuery->num_rows > 0): ?>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Text Command</th>
                <th>Saved At</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $voiceQuery->fetch_assoc()): ?>
            <tr>
                <td><?php echo htmlspecialchars($row['id']); ?></td>
                <td><?php echo htmlspecialchars($row['text_output']); ?></td>
                <td><?php echo htmlspecialchars($row['created_at']); ?></td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <?php else: ?>

    <div class="empty">
        لا توجد أوامر صوتية محفوظة حتى الآن.
    </div>

    <?php endif; ?>
</div>

</div>

</body>
</html>

<?php
$conn->close();
?>
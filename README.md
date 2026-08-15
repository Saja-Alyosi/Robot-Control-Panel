# Robot Control Panel

A modern web-based control system for remote robot operation with speech recognition and command logging capabilities.

## Features

- **🎮 Real-Time Robot Control** - Directional commands (Forward, Backward, Left, Right) with instant feedback
- **🎤 Speech-to-Text** - Voice command input using Web Speech API
- **💾 Command Logging** - Automatic storage of all voice commands in database
- **📊 Archives** - View control history and saved voice commands
- **🎨 Dark Neumorphism UI** - Modern, responsive interface with smooth animations
- **⚡ MySQL Database** - Persistent storage with real-time state updates

## Project Structure

```
├── index.html           # Main control panel interface
├── archives.php         # Command history and voice logs viewer
├── update_command.php   # Robot command update endpoint
├── save_voice.php       # Voice command storage endpoint
├── get_state.php        # Fetch current robot state
├── db.php              # Database connection configuration
└── setup.sql           # Database initialization script
```

## Technology Stack

- **Frontend**: HTML5, CSS3 (Neumorphism Design), Vanilla JavaScript
- **Backend**: PHP 7.4+
- **Database**: MySQL
- **API**: RESTful endpoints with JSON responses
- **Hosting**: InfinityFree (or any PHP-compatible server)

## Installation & Setup

### 1. Database Configuration

Edit `db.php` with your database credentials:

```php
$host = "your_host";
$user = "your_username";
$pass = "your_password";
$dbname = "your_database";
```

### 2. Initialize Database

Run the SQL script in phpMyAdmin:

```sql
CREATE TABLE robot_state (
    id INT PRIMARY KEY,
    command CHAR(1) NOT NULL,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

INSERT INTO robot_state (id, command) VALUES (1, 'S');
```

### 3. Create Voice Commands Table

```sql
CREATE TABLE voice_commands (
    id INT AUTO_INCREMENT PRIMARY KEY,
    text_output VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

### 4. Deploy Files

Upload all PHP and HTML files to your server via FTP or file manager.

## Usage

### Robot Control Panel

Access `index.html` to open the main control interface:

- **Forward** - Move robot forward
- **Backward** - Move robot backward
- **Left** - Turn left
- **Right** - Turn right
- **STOP** - Halt all movement

### Voice Commands

1. Click **🎤 Start Recording**
2. Speak your command
3. Text appears automatically
4. Click **Save Text** to store in database

### Archives

View all historical data:
- Current robot state
- Last update timestamp
- All saved voice commands with dates

## API Endpoints

### Update Command
```
POST /update_command.php
Body: command=forward|backward|left|right|stop
Response: { status, button, stored_as }
```

### Get State
```
GET /get_state.php
Response: { command, updated_at }
```

### Save Voice
```
POST /save_voice.php
Body: text=voice_command_text
Response: { status, message }
```

## Command Mapping

| Button | Stored As |
|--------|-----------|
| Forward | `f` |
| Backward | `b` |
| Left | `l` |
| Right | `r` |
| Stop | `S` |

## Browser Compatibility

- Chrome/Chromium ✅ (Full support including Speech API)
- Firefox ✅ (Partial - control panel only)
- Safari ✅ (Partial - control panel only)
- Edge ✅ (Full support)

*Speech-to-Text requires Chrome/Edge for full compatibility*

## Security Considerations

- ⚠️ Database credentials are hardcoded (use environment variables in production)
- Implement input validation on server-side
- Add CSRF token protection to POST requests
- Enable HTTPS for production deployment
- Use prepared statements (already implemented)

## Design Features

- **Neumorphism UI** - Modern shadowing and depth effects
- **Responsive Layout** - Works on desktop and mobile
- **RTL Support** - Right-to-left text direction enabled
- **Real-time Feedback** - Instant status updates
- **Smooth Animations** - CSS3 transitions throughout

## Troubleshooting

| Issue | Solution |
|-------|----------|
| Speech recognition not working | Use Chrome/Chromium browser |
| Database connection fails | Verify credentials in `db.php` |
| Commands not updating | Check database write permissions |
| Archives page shows no data | Ensure tables exist via `setup.sql` |


# 🏆 MAchievement 🏆

**MAchievement** is a plugin designed for PocketMine-MP servers, allowing players to track and manage their in-game achievements with ease.

---

## ✅ Features
- **Config Reload**: reload configurations without restarting the server.
- **50 Achievements**: Over 50 unique achievements for players to unlock.
- **Menu Options**: Choose between two menu styles for managing achievements:
    - **FormUI**: A simple and intuitive form-based menu.
    - **GUI**: A visually enhanced graphical interface.

---

## 📷 Images

---

## 📁 Installation 
1. Download the latest version of the plugin.
2. Place the `MAchievement.phar` file into the `plugins` directory of your PocketMine-MP server.
3. Restart the server to load the plugin.

---

## 🕹️ Commands

| Command              | Permission                   | Description                  |
|----------------------|-----------------------------|------------------------------|
| `/achievement`       | `achievement.use`           | Open and view achievements. |
| `/achievementreload` | `achievement.reload.command` | Reload the plugin config.   |

---

## Permissions

| Permission                   | Default |
|------------------------------|---------|
| `achievement.use`            | `true`  |
| `achievement.reload.command` | `op`    |

---

## 💾 Config

```yaml
# GUI / FORM
menu-type: GUI
# WARNING!! If you enter the wrong type, the plugin will encounter an error.
```

---

## 🔼 Todo
- [x] Support FormAPI and InvMenu
- [ ] 50 Achievements
- [ ] language.yml

---

## License
[MIT Licence]().

---

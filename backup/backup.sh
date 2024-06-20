docker exec mysql bash -c "mysqldump -pcore gemini 2>/dev/null" | cat > /home/cxpo/Desktop/Task_2/backup`/date +'%d-%m-%y_%H_%M_%S'`.sql

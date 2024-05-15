import tkinter as tk
from tkinter import filedialog, messagebox
import os
import re
import datetime
import pywintypes
import win32file

def parse_date_from_filename(filename):
    # Definir padrões da expressão regular para diferentes formatos de data no nome do arquivo
    patterns = [
        r"(\d{4}-\d{2}-\d{2} \d{2}\.\d{2}\.\d{2})",  # yyyy-MM-dd HH.mm.ss
        r"(\d{4}-\d{2}-\d{2} \d{2}\.\d{2})",         # yyyy-MM-dd HH.mm
        r"(\d{4}-\d{2}-\d{2})",                     # yyyy-MM-dd
    ]
    
    for pattern in patterns:
        match = re.search(pattern, filename)
        if match:
            date_str = match.group(1)
            if "." in date_str:
                # Se houver horas, minutos e segundos na data, usar formato completo
                date_format = "%Y-%m-%d %H.%M.%S"
            elif " " in date_str:
                # Se houver apenas data e hora, usar formato sem os segundos
                date_format = "%Y-%m-%d %H.%M"
            else:
                # Se houver apenas data, usar formato sem hora, minutos e segundos
                date_format = "%Y-%m-%d"
            try:
                parsed_date = datetime.datetime.strptime(date_str, date_format)
                return parsed_date
            except ValueError:
                continue

    return None

def change_timestamp(filename):
    parsed_date = parse_date_from_filename(filename)
    if parsed_date:
        try:
            # Converter para pywintypes.Time
            file_time = pywintypes.Time(parsed_date)
            # Usar win32file para alterar os timestamps
            file_handle = win32file.CreateFile(
                filename,
                win32file.GENERIC_WRITE,
                win32file.FILE_SHARE_READ | win32file.FILE_SHARE_WRITE | win32file.FILE_SHARE_DELETE,
                None,
                win32file.OPEN_EXISTING,
                win32file.FILE_FLAG_BACKUP_SEMANTICS,
                None
            )
            win32file.SetFileTime(file_handle, file_time, file_time, file_time)
            win32file.CloseHandle(file_handle)
            print(f"Timestamps do arquivo {filename} alterados para: {parsed_date}")
            return True
        except Exception as e:
            print(f"Erro ao alterar os timestamps do arquivo {filename}: {e}")
            return False
    else:
        print(f"Formato de data inválido no nome do arquivo {filename}.")
        return False

def change_timestamp_in_folder(folder_path):
    alterados_com_sucesso = 0
    erros = []
    for filename in os.listdir(folder_path):
        file_path = os.path.join(folder_path, filename)
        if os.path.isfile(file_path):
            if change_timestamp(file_path):
                alterados_com_sucesso += 1
            else:
                erros.append(filename)
    return alterados_com_sucesso, erros

def selecionar_pasta():
    pasta_selecionada = filedialog.askdirectory()
    label_caminho.config(text="Caminho selecionado: " + pasta_selecionada)
    btn_executar.config(command=lambda: alterar_filestamp(pasta_selecionada))

def alterar_filestamp(pasta_selecionada):
    alterados_com_sucesso, erros = change_timestamp_in_folder(pasta_selecionada)
    if alterados_com_sucesso > 0:
        messagebox.showinfo("Sucesso", f"{alterados_com_sucesso} arquivos foram alterados com sucesso.")
    elif erros:
        messagebox.showerror("Erro", f"Não foi possível alterar os timestamps dos seguintes arquivos:\n{', '.join(erros)}")
    else:
        messagebox.showwarning("Aviso", "Não foi possível alterar os timestamps de nenhum arquivo.")

# Cria a janela principal
root = tk.Tk()
root.title("Alterar FileStamp")

# Texto explicativo
texto_explicativo = tk.Label(root, text="Este programa serve para selecionar uma pasta e alterar os timestamps dos arquivos nela.")
texto_explicativo.pack()

# Botão para selecionar a pasta
btn_selecionar_pasta = tk.Button(root, text="Selecionar Pasta", command=selecionar_pasta)
btn_selecionar_pasta.pack()

# Label para mostrar o caminho selecionado
label_caminho = tk.Label(root, text="Caminho selecionado: ")
label_caminho.pack()

# Botão para executar o código
btn_executar = tk.Button(root, text="Executar")
btn_executar.pack()

# Inicia o loop principal da interface gráfica
root.mainloop()

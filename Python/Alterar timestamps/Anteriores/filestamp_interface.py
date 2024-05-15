import tkinter as tk
from tkinter import filedialog
import os
import re
import datetime
import pywintypes

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
            file_time = int(parsed_date.timestamp())
            if hasattr(pywintypes, 'SetFileTime'):
                # Usar pywin32 para alterar a data de criação (se disponível)
                pywintypes.SetFileTime(filename, creationTime=file_time, lastAccessTime=file_time, lastWriteTime=file_time)
            else:
                # Usar os.utime para alterar o timestamp em sistemas que não suportam a modificação do atributo de criação
                os.utime(filename, (file_time, file_time))
            print(f"Timestamp do arquivo {filename} alterado para: {parsed_date}")
        except Exception as e:
            print(f"Erro ao alterar o timestamp do arquivo {filename}: {e}")
    else:
        print(f"Formato de data inválido no nome do arquivo {filename}.")

def change_timestamp_in_folder(folder_path):
    for filename in os.listdir(folder_path):
        file_path = os.path.join(folder_path, filename)
        if os.path.isfile(file_path):
            change_timestamp(file_path)

def selecionar_pasta():
    pasta_selecionada = filedialog.askdirectory()
    label_caminho.config(text="Caminho selecionado: " + pasta_selecionada)
    btn_executar.config(command=lambda: alterar_filestamp(pasta_selecionada))

def alterar_filestamp(pasta_selecionada):
    change_timestamp_in_folder(pasta_selecionada)
    messagebox.showinfo("Aviso", "Filestamp alterado com sucesso!")

# Cria a janela principal
root = tk.Tk()
root.title("Alterar FileStamp")

# Texto explicativo
texto_explicativo = tk.Label(root, text="Este programa serve para selecionar uma pasta e alterar o filestamp dos arquivos nela.")
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

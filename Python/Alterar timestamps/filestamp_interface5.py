import tkinter as tk
from tkinter import filedialog, messagebox
import os
import re
import datetime
import subprocess

def parse_date_from_filename(filename):
    patterns = [
        r"(\d{4}-\d{2}-\d{2} \d{2}\.\d{2}\.\d{2})",
        r"(\d{4}-\d{2}-\d{2} \d{2}\.\d{2})",
        r"(\d{4}-\d{2}-\d{2})",
    ]
    
    for pattern in patterns:
        match = re.search(pattern, filename)
        if match:
            date_str = match.group(1)
            if "." in date_str:
                date_format = "%Y-%m-%d %H.%M.%S"
            elif " " in date_str:
                date_format = "%Y-%m-%d %H.%M"
            else:
                date_format = "%Y-%m-%d"
            try:
                parsed_date = datetime.datetime.strptime(date_str, date_format)
                return parsed_date
            except ValueError:
                continue
    return None

def change_metadata_date(filename, date):
    date_str = date.strftime("%Y:%m:%d %H:%M:%S")
    try:
        subprocess.run(["exiftool", "-overwrite_original",
                        f"-alldates={date_str}",
                        f"-FileCreateDate={date_str}",
                        f"-FileModifyDate={date_str}",
                        filename], check=True)
        print(f"Metadata date for {filename} changed to {date_str}")
        return True
    except subprocess.CalledProcessError as e:
        print(f"Error changing metadata date for {filename}: {e}")
        return False

def change_metadata_in_folder(folder_path):
    alterados_com_sucesso = 0
    erros = []
    for filename in os.listdir(folder_path):
        file_path = os.path.join(folder_path, filename)
        if os.path.isfile(file_path):
            date = parse_date_from_filename(filename)
            if date:
                if change_metadata_date(file_path, date):
                    alterados_com_sucesso += 1
                else:
                    erros.append(filename)
            else:
                erros.append(filename)
    return alterados_com_sucesso, erros

def selecionar_pasta():
    pasta_selecionada = filedialog.askdirectory()
    label_caminho.config(text="Caminho selecionado: " + pasta_selecionada)
    btn_executar.config(command=lambda: alterar_filestamp(pasta_selecionada))

def alterar_filestamp(pasta_selecionada):
    alterados_com_sucesso, erros = change_metadata_in_folder(pasta_selecionada)
    if alterados_com_sucesso > 0:
        messagebox.showinfo("Sucesso", f"{alterados_com_sucesso} arquivos foram alterados com sucesso.")
    if erros:
        messagebox.showerror("Erro", f"Não foi possível alterar os seguintes arquivos:\n{', '.join(erros)}")

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

CREATE TABLE associados (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(150) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    cpf VARCHAR(11) NOT NULL UNIQUE,
    data_filiacao DATE NOT NULL
);

CREATE TABLE anuidades (
    id INT AUTO_INCREMENT PRIMARY KEY,
    ano INT NOT NULL UNIQUE,
    valor DECIMAL(10, 2) NOT NULL,
    status_pagamento ENUM('pago', 'não pago') DEFAULT 'não pago'
);

CREATE TABLE pagamentos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    associado_id INT NOT NULL,
    anuidade_id INT NOT NULL,
    status_id INT NOT NULL,
    data_pagamento TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (associado_id) REFERENCES associados(id),
    FOREIGN KEY (anuidade_id) REFERENCES anuidades(id),
    FOREIGN KEY (status_id) REFERENCES status_pagamento(id)
);

CREATE TABLE status_pagamento (
    id INT AUTO_INCREMENT PRIMARY KEY,
    descricao VARCHAR(50) NOT NULL
);


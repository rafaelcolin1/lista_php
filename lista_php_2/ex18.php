<?php
function organizarAgenda($consultas) {
    $totalConsultas = count($consultas);
    $pacientesDiferentes = contarPacientesDiferentes($consultas);
    $consultasPorEspecialidade = contarConsultasPorEspecialidade($consultas);
    $primeiroAtendimento = encontrarPrimeiroAtendimento($consultas);
    $ultimoAtendimento = encontrarUltimoAtendimento($consultas);
    $agendaOrdenada = ordenarAgendaPorHorario($consultas);
    $horariosDuplicados = verificarHorariosDuplicados($consultas);

    return [
        "total_consultas" => $totalConsultas,
        "pacientes_diferentes" => $pacientesDiferentes,
        "consultas_por_especialidade" => $consultasPorEspecialidade,
        "primeiro_atendimento" => $primeiroAtendimento,
        "ultimo_atendimento" => $ultimoAtendimento,
        "agenda_ordenada" => $agendaOrdenada,
        "horarios_duplicados" => $horariosDuplicados
    ];
}

function contarPacientesDiferentes($consultas) {
    $pacientes = [];
    foreach ($consultas as $consulta) {
        $pacientes[$consulta['nome']] = true;
    }
    return count($pacientes);
}

function contarConsultasPorEspecialidade($consultas) {
    $especialidades = [];
    foreach ($consultas as $consulta) {
        if (!isset($especialidades[$consulta['especialidade']])) {
            $especialidades[$consulta['especialidade']] = 0;
        }
        $especialidades[$consulta['especialidade']]++;
    }
    return $especialidades;
}

function encontrarPrimeiroAtendimento($consultas) {
    usort($consultas, function($a, $b) {
        return strtotime($a['data'] . ' ' . $a['horario']) - strtotime($b['data'] . ' ' . $b['horario']);
    });
    return $consultas[0];
}

function encontrarUltimoAtendimento($consultas) {
    usort($consultas, function($a, $b) {
        return strtotime($a['data'] . ' ' . $a['horario']) - strtotime($b['data'] . ' ' . $b['horario']);
    });
    return $consultas[count($consultas) - 1];
}

function ordenarAgendaPorHorario($consultas) {
    usort($consultas, function($a, $b) {
        return strtotime($a['data'] . ' ' . $a['horario']) - strtotime($b['data'] . ' ' . $b['horario']);
    });
    return $consultas;
}

function verificarHorariosDuplicados($consultas) {
    $horarios = [];
    $duplicados = [];
    foreach ($consultas as $consulta) {
        $chave = $consulta['data'] . ' ' . $consulta['horario'];
        if (isset($horarios[$chave])) {
            $duplicados[] = $consulta;
        } else {
            $horarios[$chave] = true;
        }
    }
    return $duplicados;
}

function pesquisarPaciente($consultas, $nomePaciente) {
    $resultados = [];
    foreach ($consultas as $consulta) {
        if (strcasecmp($consulta['nome'], $nomePaciente) == 0) {
            $resultados[] = $consulta;
        }
    }
    return $resultados;
}

function exibirAgenda($agenda) {
    foreach ($agenda as $consulta) {
        echo "Nome: " . $consulta['nome'] . "<br>";
        echo "Especialidade: " . $consulta['especialidade'] . "<br>";
        echo "Data: " . $consulta['data'] . "<br>";
        echo "Horário: " . $consulta['horario'] . "<br><br>";
    }
}

$consultas = [
    [
        "nome" => "João",
        "especialidade" => "Cardiologia",
        "data" => "04/10/2026",
        "horario" => "08:00"
    ],
    [
        "nome" => "Maria",
        "especialidade" => "Dermatologia",
        "data" => "03/05/2026",
        "horario" => "09:00"
    ],
    [
        "nome" => "Pedro",
        "especialidade" => "Cardiologia",
        "data" => "24/11/2026",
        "horario" => "10:00"
    ],
    [
        "nome" => "Ana",
        "especialidade" => "Pediatria",
        "data" => "028/03/2026",
        "horario" => "11:00"
    ]
];
?>
<form method="post">
    <label for="nomePaciente">Pesquisar paciente:</label>
    <input type="text" name="nomePaciente" id="nomePaciente" required>
    <input type="submit" value="Pesquisar">
</form>

<?php
echo "<h2>Agenda de Consultas</h2>";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nomePaciente = $_POST["nomePaciente"];
    $resultados = pesquisarPaciente($consultas, $nomePaciente);
    if (count($resultados) > 0) {
        echo "<h3>Resultados da pesquisa para '$nomePaciente':</h3>";
        exibirAgenda($resultados);
    } else {
        echo "<p>Nenhum paciente encontrado com o nome '$nomePaciente'.</p>";
    }
}
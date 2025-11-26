<?php require_once 'logic.php'; ?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TCC - Projeto Interativo</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header class="no-dark">
       <img src="logo.jpg" class="ima" alt="V-machine 4.0" > 
       <h1>V - Machine 4.0</h1>
    </header>

    <div class="menu" id="menu">
        <br><br><br><br>
        <div class="menu-links">
            <div class="menu-item">
                <div class="menu-icon"><i class="fas fa-info-circle"></i></div>
                <a href="#informacoes" class="menu-label tab-link active">Informações</a>
            </div>
            <div class="menu-item">
                <div class="menu-icon"><i class="fas fa-envelope"></i></div>
                <a href="#contato" class="menu-label tab-link">Contato</a>
            </div>
            <div class="menu-item">
                <div class="menu-icon"><i class="fas fa-camera"></i></div>
                <a href="#fotos" class="menu-label tab-link">Fotos</a>
            </div>
            <div class="menu-item">
                <div class="menu-icon"><i class="fas fa-users"></i></div>
                <a href="#participantes" class="menu-label tab-link">Participantes</a>
            </div>
        </div>
    </div>

    <div class="narrator-box" id="narratorBox">
        <button onclick="startReading()" aria-label="Iniciar leitura em voz alta">
            Iniciar Leitura
        </button>
        <button id="pauseResumeButton" onclick="pauseResumeReading()" aria-label="Pausar ou retomar leitura">
            Pausar Leitura
        </button>
    </div>
<br><br><br><br>
    <div class="content">


        <!-- INFORMAÇÕES -->
        <div id="informacoes" class="content-section active">
            <h1>Bem-vindo à V-MACHINE 4.0</h1>
            <div class="info-subsection objetivo">
                <h3>Objetivo</h3>
                <p>Desenvolver uma <strong>máquina de vendas automática</strong> de baixo custo, fácil montagem e feita com <strong>materiais baratos e reutilizáveis</strong>, utilizando o <strong>Arduino</strong>(micro computador) como cérebro. A solução é pensada para <strong>pequenos comerciantes</strong> que desejam se destacar no mercado com inovações acessíveis e de fácil manuseio. A <strong>versão 1</strong> é construída com <strong>papelão, plástico e materiais reciclados</strong>, enquanto a <strong>versão 2</strong> já é feita de <strong>MDF, metais e plásticos</strong>, oferecendo maior durabilidade e profissionalismo.</p>
            </div>
            <div class="info-subsection materiais">
                <h3>Materiais</h3>
                <p><strong>Versão 1:</strong> Servo motores, plástico, papelão reciclável, fios, bateria, metal e Arduino. Tudo pensado para ser <strong>barato, acessível e sustentável</strong>.<br>
                <strong>Versão 2:</strong> Mantém os mesmos componentes, mas substituindo o papelão por MDF, ganhando uma estrutura mais robusta, resistente e profissional.</p>
            </div>
            <div class="info-subsection justificativa">
                <h3>Justificativa</h3>
                <p>O projeto V-MACHINE 4.0 justifica-se pela <strong>demanda real de pequenos comerciantes</strong> por soluções práticas e de baixo custo que ampliem suas vendas sem exigir grandes investimentos ou mão de obra constante. Em um mercado cada vez mais competitivo, oferecer uma <strong>vitrine automatizada 24 horas</strong> com <strong>manutenção simples e custo acessível</strong> representa não apenas uma vantagem operacional, mas um <strong>diferencial estético e funcional</strong> que atrai clientes e transmite inovação.<br><br>
Mais do que uma máquina, o projeto demonstra que <strong>tecnologia de alto impacto pode nascer da criatividade e do reaproveitamento inteligente de materiais</strong>. Prova-se, na prática, que <strong>limitações financeiras não são barreiras intransponíveis</strong> — com planejamento, Arduino e materiais do dia a dia, é possível criar uma solução robusta, sustentável e visualmente atraente, capaz de <strong>impulsionar negócios locais com elegância e eficiência</strong>.</p>
            </div>
        </div>



       <!-- CONTATO - COM CONTADOR E PERMANECE NA ABA -->
        <div id="contato" class="content-section <?php echo (isset($_POST['enviar']) ? 'active' : ''); ?>">
            <h2>Contato</h2>
            <div class="contact-form">
                <form method="POST">
                    <input type="hidden" name="enviar" value="1">
                    <label for="name">Nome:</label>
                    <input type="text" name="nome" id="name" placeholder="Seu nome" value="<?php echo htmlspecialchars($_POST['nome'] ?? ''); ?>" required>

                    <label for="email">Email:</label>
                    <input type="email" name="email" id="email" placeholder="Seu email" value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>" required>

                    <label for="message">Mensagem: <span id="contador">0/500</span></label>
                    <textarea name="mensagem" id="message" rows="5" placeholder="Sua mensagem" maxlength="500" required><?php echo htmlspecialchars($_POST['mensagem'] ?? ''); ?></textarea>

                    <button type="submit"  class="no-dark-button">Enviar</button>
                </form>

                <div style="margin-top:15px; text-align:center; font-weight:bold;">
                    <?php echo $mensagem; ?>
                </div>
            </div>
        </div>



        
        <!-- FOTOS -->
        <div id="fotos" class="content-section">
            <h2>Fotos</h2>
            <div class="photo-gallery">
                <div class="photo-item"><img src="maq-1.jpg" alt="Foto 1"></div>
                <div class="photo-item"><img src="maq-2.jpg" alt="Foto 2"></div>
                <div class="photo-item"><img src="maq-3.jpg" alt="Foto 3"></div>
                <div class="photo-item"><img src="n-1.jpg" alt="Foto 3"></div>
                <div class="photo-item"><img src="n-2.jpg" alt="Foto 3"></div>
                <div class="photo-item"><img src="n-3.jpg" alt="Foto 3"></div>
            </div>
        </div>





        <!-- PARTICIPANTES -->
        <div id="participantes" class="content-section">
            <div class="participant-container">
                <h2>Participantes</h2>
                <div class="participant-carousel">
                    <i class="fas fa-chevron-left carousel-arrow left"></i>
                    <div class="participant-card" data-index="0"><img src="caina.jpg" alt="Cainã" class="participant-photo">
                    <div class="participant-info"><h3>Cainã Carreira de Almeida</h3><p>...</p></div></div>


                    <div class="participant-card" data-index="1"><img src="jao-M.jpg" alt="João Gabriel" class="participant-photo">
                    <div class="participant-info"><h3>João Gabriel Martins Carreira</h3><p>...</p></div></div>


                    <div class="participant-card" data-index="2"><img src="jao-V.jpg" alt="João Vitor" class="participant-photo"><div class="participant-info"><h3>João Vitor Matos Pelussi</h3><p>...</p></div></div>
                    <div class="participant-card" data-index="3"><img src="natan.jpg" alt="Natanael" class="participant-photo"><div class="participant-info"><h3>Natanael Victor Rodrigues Guimarães</h3><p>...</p></div></div>
                    <div class="participant-card" data-index="4"><img src="victor.jpg" alt="Victor" class="participant-photo"><div class="participant-info"><h3>Victor Araujo Blasques</h3><p>...</p></div></div>
                    <i class="fas fa-chevron-right carousel-arrow right"></i>
                </div>
            </div>
        </div>
    </div>

    <footer id="footer"><p>© 2025 Projeto TCC - Todos os direitos reservados</p></footer>

    <button id="accessibility-float-btn" aria-label="Abrir opções de acessibilidade" onclick="toggleAccessibilityPanel()">
        <i class="fas fa-universal-access"></i>
    </button>

    <script>
        window.isPostSent = <?php echo isset($_POST['enviar']) ? 'true' : 'false'; ?>;
    </script>
    <script src="script.js"></script>
</body>
</html>
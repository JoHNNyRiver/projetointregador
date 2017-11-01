<?php
  include_once('../db/verifysession.php');
  include_once('../includes/header.php');
?>
    <div class="container">
        <div class="col s12 sample-admin">
            <div class="overflow">
              <div class="col s4 space hd">
                <span class="grey-text">ESPAÇO LIVRE EM DISCO</span>
                <div class="space__disk grey-text">
                  <?php
                    $space = @disk_free_space('/dev/sda1') ? @disk_free_space('/dev/sda1') : @disk_free_space('c:');
                    echo substr($space / 1024 / 1024 / 1024, 0, 3).'<sub>GB</sub>';
                  ?>
                </div>
              </div>

              <div class="col s4 space memory">
                <span class="grey-text">MEMORIA EM USO</span>
                <div class="space__disk grey-text">
                  <?php
                    $space = ('c:') ? 'c:' : '/dev/sda1';
                    echo substr(memory_get_usage() / 1024, 0, 3).'<sub>KB</sub>';
                  ?>
                </div>
              </div>

              <div class="col s4 space users">
                <span class="grey-text">LOGADO COMO</span>
                <div class="space__disk grey-text">
                  <?= strtoupper($_SESSION['user']); ?>
                </div>
              </div>
            </div>
        </div>

        <br>

        <div class="row">
            <div class="col s12">
               <canvas id="graficoPedidos"></canvas>
            </div>
          </div>
    </div>


<div class="container">
	<div class="row">
		<div class="col s12">
		<div class="col s12 m6">
		  <h5 class="center list-clients">LISTA DE CLIENTES</h5>

		  <div class="wrap-overflow">
			  <table class="centered striped responsive-table">
				  <thead>
					<tr>
						<th>ID</th>
						<th>NOME</th>
						<th>Email</th>
						<th>EDITAR</th>
						<th>DELETAR</th>
					</tr>
				  </thead>

				  <tbody>

					  <?php
						  $result = odbc_exec($db, 'SELECT idCliente, nomeCompletocliente, emailCliente FROM Cliente');
						  while($clients = odbc_fetch_array($result)):
					  ?>

					   <tr>
						  <td><?= $clients['idCliente']; ?></td>
						  <td><?= $clients['nomeCompletocliente']; ?></td>
						  <td><?= $clients['emailCliente']; ?></td>
						  <th><a href="./editar.php?editarClient=<?= $clients['idCliente']; ?>"><i class="material-icons">create</i></a></th>
						  <th><a href="./excluir?excluirClient=<?= $clients['idCliente']; ?>"><i class="material-icons">delete_forever</i></a></th>
					  </tr>

					  <?php endwhile; ?>
				  </tbody>
			  </table>
		  </div>
		</div>

		<div class="col s12 m6">
			<h5 class="center list-clients">LISTA DE PRODUTOS</h5>
			<div class="wrap-overflow">
				<table class="centered striped responsive-table">
					<thead>
					  <tr>
						  <th>ID</th>
						  <th>NOME</th>
						  <th>DESCRIÇÃO</th>
						  <th>EDITAR</th>
						  <th>DELETAR</th>
					  </tr>
					</thead>

					<tbody>
						<?php
							$result = odbc_exec($db, 'SELECT idProduto, nomeProduto, descProduto FROM Produto');
							while ($products = odbc_fetch_array($result)):
						?>
						<tr>
							<td><?= utf8_encode($products['idProduto']); ?></td>
							<td><div class="nowrap"><?= utf8_encode($products['nomeProduto']); ?></div></td>
							<td><div class="nowrap"><?= utf8_encode($products['descProduto']); ?></div></td>
							<th><a href="./editar.php?editarproduto=<?= $products['idProduto'];?>"><i class="material-icons">create</i></a></th>
							<th><a href="./excluir?excluirproduto=<?= $products['idProduto'];?>"><i class="material-icons">delete_forever</i></a></th>
						</tr>
						<?php endwhile; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
</div>

<?php include_once('../includes/footer.php') ?>

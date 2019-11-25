<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="cs" lang="cs">
	<head>
		<meta http-equiv="content-language" content="cs" />
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="author" content="codeall: helvete" />
		<meta name="robots" content="noindex, nofollow" />
		<meta name="description" content="antibot" />
		<title>Are you a bot?</title>
	</head>
	<body style="margin: 20px; padding: 5px; background-color: black; color: white;">
		<h1 title="Rewrite numbers in correct order">Anti bot system</h1>
		<table>
			<tr>
				<?php echo $firstRow; ?>
			</tr>
			<tr>
				<td colspan="8">
					<form>
						<input autocomplete="off" type="text" name="odbot" style="width: 100px;" />
						<input type="hidden" name="rada" value="<?php echo $poleString ?>">
						<input type="submit" value="Check" />
					</form>
				</td>
			</tr>
		</table>
		<span style="float:right; color: white; font-size: 9px;">version 1.2</span>
	</body>
</html>


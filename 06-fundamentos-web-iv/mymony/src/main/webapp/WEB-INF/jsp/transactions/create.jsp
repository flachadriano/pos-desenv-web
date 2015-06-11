<%@ page language="java" contentType="text/html; charset=UTF-8"
	pageEncoding="UTF-8"%>
<%@ taglib uri="http://java.sun.com/jsp/jstl/core" prefix="c"%>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Nova transação</title>
</head>

<body>
	<form action="" method="POST">
		Categoria: <input type="text" name="transaction.category_id" /><br />
		Data: <input type="text" name="transaction.due_date" /><br /> Valor:
		<input type="text" name="transaction.value" /><br /> Descrição: <input
			type="text" name="transaction.description" /><br /> <input
			type="submit" value="Criar" />
	</form>
</body>

</html>
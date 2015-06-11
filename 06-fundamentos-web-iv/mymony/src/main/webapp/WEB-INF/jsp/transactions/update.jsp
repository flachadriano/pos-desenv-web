<%@ page language="java" contentType="text/html; charset=UTF-8"
	pageEncoding="UTF-8"%>
<%@ taglib uri="http://java.sun.com/jsp/jstl/core" prefix="c"%>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Editar transação</title>
</head>

<body>
	<form action="<c:url value="${transaction.id}"/>" method="POST">
		Categoria: <input type="text" name="transaction.category_id"
			value="${transaction.category_id}" /><br /> Data: <input
			type="text" name="transaction.due_date"
			value="${transaction.due_date}" /><br /> Valor: <input type="text"
			name="transaction.value" value="${transaction.value}" /><br />
		Descrição: <input type="text" name="transaction.description"
			value="${transaction.description}" /><br /> <input type="submit"
			value="Atualizar" />
	</form>
</body>

</html>
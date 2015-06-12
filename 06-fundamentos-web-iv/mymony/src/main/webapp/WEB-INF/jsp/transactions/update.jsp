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
		Categoria: <select name="transaction.category_id">
			<c:forEach var="category" items="${categories}">
				<option value="${category.id}"
					<c:if
						test="${transaction.category_id == category.id}"> selected="true" </c:if>>${category.name}
				</option>
			</c:forEach>
		</select><br />
		<!-- c -->
		Data: <input type="text" name="transaction.due_date"
			value="${transaction.due_date}" /><br />
		<!-- c -->
		Valor: <input type="text" name="transaction.value"
			value="${transaction.value}" /><br />
		<!-- c -->
		Descrição: <input type="text" name="transaction.description"
			value="${transaction.description}" /><br />
		<!-- c -->
		<input type="submit" value="Atualizar" />
	</form>
</body>

</html>
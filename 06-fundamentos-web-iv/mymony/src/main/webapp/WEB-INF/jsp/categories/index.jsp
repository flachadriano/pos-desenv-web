<%@ page language="java" contentType="text/html; charset=UTF-8"
	pageEncoding="UTF-8"%>
<%@ taglib uri="http://java.sun.com/jsp/jstl/core" prefix="c"%>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>MyMony</title>
</head>

<body>

	<h1>Categorias</h1>

	<a href="create">Criar categoria</a>

	<table>
		<c:forEach var="category" items="${categories}">
			<tr>
				<td>${category.id}</td>
				<td>${category.name}</td>
				<td><a href="update/${category.id}">Editar</a></td>
				<td>
					<form action="<c:url value="destroy/${category.id}"/>"
						method="POST">
						<button class="link" name="_method" value="DELETE">Deletar</button>
					</form>
				</td>
			</tr>
		</c:forEach>
	</table>

</body>

</html>
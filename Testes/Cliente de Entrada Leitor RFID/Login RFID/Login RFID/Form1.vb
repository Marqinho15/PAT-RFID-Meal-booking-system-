Imports MySql.Data.MySqlClient

Public Class Form1
    Dim ServerString As String = "Server=localhost;User Id=root;Password=;Database=rfid"
    Dim SQLConnection As MySqlConnection = New MySqlConnection
    Private Sub Button2_Click(sender As Object, e As EventArgs) Handles Button2.Click
        End
    End Sub

    Private Sub TextBox2_TextChanged(sender As Object, e As EventArgs) Handles TextBox2.TextChanged

    End Sub

    Private Sub TextBox1_TextChanged(sender As Object, e As EventArgs) Handles TextBox1.TextChanged

    End Sub

    Private Sub Label1_Click(sender As Object, e As EventArgs) Handles Label1.Click

    End Sub

    Private Sub Form1_Load(sender As Object, e As EventArgs) Handles MyBase.Load

        SQLConnection.ConnectionString = ServerString
        Try
            If SQLConnection.State = ConnectionState.Closed Then
                SQLConnection.Open()
                MsgBox("Ligado Com Sucesso à Base Dados")
            Else
                SQLConnection.Close()
                MsgBox("Ligação à Base de Dados inativa")
            End If
        Catch ex As Exception
            MsgBox(ex.ToString)
        End Try

    End Sub

    Private Sub Button1_Click(sender As Object, e As EventArgs) Handles Button1.Click
        If TextBox1.Text = "admin" And TextBox2.Text = "12345" Then
            Form6.Show()
            Me.Close()
        Else
            MsgBox("Dados de Login Incorretos", vbCritical, "ERRO")
            TextBox1.Text = ""
            TextBox2.Text = ""
        End If
    End Sub
End Class
